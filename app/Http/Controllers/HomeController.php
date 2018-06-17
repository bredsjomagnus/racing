<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trackdata as Trackdata;
use App\Models\Racetrack as Racetrack;
use App\Models\Race as Race;

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
		$race 		= new Race();
		$trackdata 	= new Trackdata();
		$racetrack 	= new Racetrack();

		$numberoftrackdata = $trackdata->getNumberOfRows();

		$races = $race->getAll();
		$trackdataids = $racetrack->getAllTrackDataInfoByRace($races);

		$data = [
			"races"				=> $races,
			"trackdataids"		=> $trackdataids,
			"numberoftrackdata"	=> $numberoftrackdata
		];
        return view('home', $data);
    }

	public function phpinfo() {
		return view('phpinfo');
	}

	public function test() {
		return view('data.testrange');
	}
}
