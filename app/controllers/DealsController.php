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
			return View::make('deal.home',['deals' => Deal::getDeals(),'regions' => Region::getAllRegions(), 'usersRegion' => $regionId[0]->regionId]);
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

	public function getDealByRegion()
	{
		return Input::all();
	}

}
