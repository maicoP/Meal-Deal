<?php

class DealsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct(Deal $deal)
	{
		$this->deal = $deal;
	}

	public function index()
	{
		if(Auth::check())
		{
			$regionId = User::getRegionId(Auth::Id());
			$regionId = $regionId[0]->regionId;		
			return View::make('deal.home',['deals' => Deal::getDealByRegion($regionId),'regions' => Region::getAllRegions(), 'selectedRegion' => $regionId , 'selectedAfhaalMethode' => 2]);
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
		if(Auth::check())
		{
			return View::make('deal.create');
		}
		else
		{
			return Redirect::to('/');
		}
		
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
			$input = Input::all();

			if( $this->deal->fill($input)->isValid())
			{
				$filename = 'nofile.png';
				if(Input::hasFile('afbeeldingdeal'))
				{
					$filename = Input::file('afbeeldingdeal')->getClientOriginalName();
					$image = Image::make(Input::file('afbeeldingdeal')->getRealPath())->heighten(400);
					$destenation = 'img/deals/'.$filename;
					$image->save($destenation);
				}
				$this->deal->afbeeldingdeal= $filename;
				$this->deal->gerecht = htmlspecialchars(Input::get('gerecht'));
				$this->deal->afhaaluur = htmlspecialchars(Input::get('afhaaluur'));
				$this->deal->dealeinde = htmlspecialchars(Input::get('dealeinde'));
				$this->deal->verkoperId = Auth::id();
				$this->deal->save();
				$dealId = $this->deal->id;
				$userId = Auth::id();
				Portie::savePorties(Input::get('porties'),$dealId,$userId);

				return Redirect::to('deals');

			}
			else
			{
				return Redirect::back()->withInput()->withErrors($this->deal->errors);
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
		//
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

	public function filter()
	{
		if(Auth::check())
		{

			$regionId = Input::get('regionId');
			
			$deals =  Deal::getDealByRegion($regionId);
			$methode = 2;
			if(Input::get('afhalen') !== null)
			{
				if(Input::get('afhalen') !== "2")
				{
					$deals = Deal::getDealByAfhaalMethode(Input::get('afhalen'),$regionId);
					$methode = Input::get('afhalen');
				}

			}
			
			return View::make('deal.home',['deals' => $deals,'regions' => Region::getAllRegions(), 'selectedRegion' => $regionId , 'selectedAfhaalMethode' => $methode]);
		}
		else
		{
			return Redirect::to('/');
		}
	}

}
