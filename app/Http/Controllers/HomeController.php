<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trackdata as Trackdata;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$trackdata = new Trackdata();
		$numberoftrackdata = $trackdata->getNumberOfRows();
		$data = [
			"numberoftrackdata"	=> $numberoftrackdata
		];
        return view('home', $data);
    }
}
