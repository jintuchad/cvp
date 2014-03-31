<?php

class DashboardController extends \BaseController {

	/**
	 * Create a new controller instance.
	 *
	 * @return Controller
	 */
	public function __construct()
	{
		
	}

	/**
	 * Display the default dashboard page
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('dashboard.index');
	}

}