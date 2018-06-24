<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mylapsdata as Mylapsdata;
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
		$mylapsdata = new Mylapsdata();
		$racetrack 	= new Racetrack();

		$numberoftrackdata = $mylapsdata->getNumberOfRows();

		$races = $race->getAll();
		$mylapsdataids = $racetrack->getAllTrackDataInfoByRace($races, 'mylaps');
		$hardcarddataids = $racetrack->getAllTrackDataInfoByRace($races, 'hardcard');

		$data = [
			"races"				=> $races,
			"mylapsdataids"		=> $mylapsdataids,
			"hardcarddataids"	=> $hardcarddataids,
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
