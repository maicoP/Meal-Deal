<?php

class myDealsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct(Deal $deal,Portie $portie)
	{
		$this->deal = $deal;
		$this->portie = $portie;
	}

	public function index()
	{
		if(Auth::check())
		{
			$beschikbaar = $this->deal->getMyDealsBeschikbaar();
			$verkopen= $this->deal->getMyDealsVerkopen();
			$kopen= $this->deal->getMyDealsKopen();
			return View::make('deal.mydeals',['dealsBeschikbaar' => $beschikbaar,'dealsVerkopen' => $verkopen,'dealsKopen' => $kopen]);
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
			$this->portie->aanvraagPortie(Input::get('dealId'));
			return Redirect::to('mydeals');
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
			$this->portie->acceptPortie($id);
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
