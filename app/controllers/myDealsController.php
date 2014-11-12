<?php

class myDealsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct(User $user,Deal $deal,Portie $portie)
	{
		$this->deal = $deal;
		$this->portie = $portie;
		$this->user = $user;
	}

	public function index()
	{
		if(Auth::check())
		{
			$beschikbaar = $this->deal->getMyDealsBeschikbaar();
			$verkopenGeaccepteert= $this->deal->getMyDealsVerkopenGeaccepteert();
			$verkopenAangevraagt= $this->deal->getMyDealsVerkopenAagevraagt();
			$kopen= $this->deal->getMyDealsKopen();
			$this->user->deleteNotifications();
			return View::make('deal.mydeals',['dealsBeschikbaar' => $beschikbaar,'VerkopenAangevraagt' => $verkopenAangevraagt,'VerkopenGeaccepteert' => $verkopenGeaccepteert,'dealsKopen' => $kopen]);
		}
		else
		{
			return Redirect::to('/');
		}
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::check())
		{
			if(Auth::user()->coins > 0)
			{
				if($this->user->getAantalAanvragen(Auth::id()) < Auth::user()->coins)
				{
					$dealId = Input::get('dealId');
					$this->portie->aanvraagPortie($dealId);
					//data van koper verkoper en deal opvragen
					$dealVerkoper = $this->deal->getDealVerkoper($dealId);
					$emailVerkoper = $dealVerkoper->user->email;
					$naamVerkoper = $dealVerkoper->user->naam;
					$gerecht = $dealVerkoper->gerecht;
					//mail versturen
					$data = array('naamVerkoper' =>  $naamVerkoper , 'naamKoper' => Auth::user()->naam , 'gerecht' => $gerecht);
					Mail::send('emails.dealAanvraag',$data, function($message) use($emailVerkoper,$naamVerkoper)
					{
					 $message->to($emailVerkoper, $naamVerkoper)->subject("Meal Deal aanvraag");
					});
					return Redirect::to('mydeals');		
				}
				else
				{
					return Redirect::to('deals')->with('error', 'U kan geen deal meer aanvragen, u hebt al aanvragen open staan.');
				}
				
			}
			else
			{
				return Redirect::to('deals')->with('error', 'U kan geen deal maken want uw coins zijn op, verkoop zelf deals om coins te ontvangen');
			}
			
		}
		else
		{
			return Redirect::to('/');
		}
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(Auth::check())
		{
			//data van koper,verkoper en deal opvragen
			$portieKoper = $this->portie->getPortieKoper($id);
			$emailKoper =  $portieKoper->koper->email;
			$naamKoper = $portieKoper->koper->naam;
			$naamVerkoper = $portieKoper->verkoper->naam;
			$gerecht =  $portieKoper->deal->gerecht;
			switch (Input::get('type')) {
			  case 'accepteer':

				$this->portie->acceptPortie($id);
				$koperId =  $this->portie->getKoperId($id);
				$this->user->addCoin(Auth::id());
				$this->user->deleteCoin($koperId);
				$this->deal->checkBadge(Auth::id());

				//data ophalen wanneer men accepteert
				$verkoper = Auth::user();
				$adress = $verkoper->straatnaam." ".$verkoper->huisnummer." ".$verkoper->postcode." ".$verkoper->gemeente;
				$emailVerkoper = $verkoper->email;
				$afhaaluur = $portieKoper->deal->afhaaluur;
				if($verkoper->postbus != "")
				{
					$adress =$adress." Postbus: ".$verkoper->postbus;
				}

				//mail versturen voor acceptatie
				$data = array('naamVerkoper' =>  $verkoper->naam , 'naamKoper' => $naamKoper , 'gerecht' => $gerecht,'adress' => $adress,'emailVerkoper' => $emailVerkoper,'afhaaluur' => $afhaaluur);
				Mail::send('emails.dealGeaccepteert',$data, function($message) use($emailKoper,$naamKoper)
				{
				 $message->to($emailKoper, $naamKoper)->subject("Meal Deal Geaccepteerd");
				});
			    break;

			  case 'wijger':
			  	//portie terug beschikbaar zetten
				$koperId =  $this->portie->getKoperId($id);
				$this->portie->wijgerPortie($id);
				//mail versturen voor wijgering
				$data = array('naamVerzender' =>  $naamVerkoper , 'naamOntvanger' => $naamKoper , 'gerecht' => $gerecht,'boodschap' => 'je aanvraag geweigerd');
				Mail::send('emails.dealWijgeren',$data, function($message) use($emailKoper,$naamKoper)
				{
				 $message->to($emailKoper, $naamKoper)->subject("Meal Deal Geweigerd");
				});
			    break;

			  case 'afzeggen':
			  	//portie terug beschikbaar zetten en bij de verkoper een coin aftellen en terug bij de koper optellen
			    $koperId =  $this->portie->getKoperId($id);
				$this->user->deleteCoin(Auth::id());
				$this->user->addCoin($koperId);
				$this->portie->wijgerPortie($id);
				$this->deal->checkBadge(Auth::id());

				//mail verzenden dat de deal niet door gaat
			  	$data = array('naamVerzender' =>  Auth::user()->naam , 'naamOntvanger' => $naamKoper , 'gerecht' => $gerecht,'boodschap' => 'de deal afgezegt(wegens omstandigheden)');
				Mail::send('emails.dealWijgeren',$data, function($message) use($emailKoper,$naamKoper)
				{
				 $message->to($emailKoper, $naamKoper)->subject("Meal Deal afgezegt");
				});
			    break;
			  case 'aanvraag intrekken':
			  	//portie terug beschikbaar zetten
			    $this->portie->wijgerPortie($id);
			  	$emailVerkoper = $portieKoper->verkoper->email;

			  	//mail verzenden dat de deal niet door gaat
			    $data = array('naamVerzender' =>  Auth::user()->naam , 'naamOntvanger' => $naamVerkoper , 'gerecht' => $gerecht,'boodschap' => 'de aanvraag ingetrokken');
				Mail::send('emails.dealWijgeren',$data, function($message) use($emailVerkoper,$naamVerkoper)
				{
				 $message->to($emailVerkoper, $naamVerkoper)->subject("Meal Deal aanvraag ingetroken");
				});
			    break;
			  case 'Acceptatieafzeggen':
				// portie terug beschikbaar zetten + coins bij verkoper afnemen bij koper terug toevoegen
			    $this->portie->wijgerPortie($id);
			    $this->user->deleteCoin($portieKoper->verkoper->id);
				$this->user->addCoin(Auth::id());
			    $emailVerkoper = $portieKoper->verkoper->email;
			    $this->deal->checkBadge($portieKoper->verkoper->id);

			    //mail verzenden dat de deal niet door gaat
			    $data = array('naamVerzender' =>  Auth::user()->naam , 'naamOntvanger' => $naamVerkoper , 'gerecht' => $gerecht,'boodschap' => 'de deal afgezegt(wegens omstandigheden)');
				Mail::send('emails.dealWijgeren',$data, function($message) use($emailVerkoper,$naamVerkoper)
				{
				 $message->to($emailVerkoper, $naamVerkoper)->subject("Meal Deal afgezegt");
				});
			    break;

			  default:
			    
			}
			
			return Redirect::back();
		}
		else
		{
			return Redirect::to('/');
		}
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
