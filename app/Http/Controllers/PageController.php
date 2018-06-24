<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Race as Race;
use App\Models\Racetrack as Racetrack;
use App\Models\Mylapsdata as Mylapsdata;
use App\Models\Hardcarddata as Hardcarddata;
use App\Models\Teamlap as Teamlap;

class PageController extends Controller
{
	public function welcome() {
		$race 			= new Race();
		$racetrack 		= new Racetrack();
		$mylapsdata 	= new Mylapsdata();
		$hardcarddata 	= new Hardcarddata();
		$teamlap		= new Teamlap();

		$races			= $race->getAll();

		$res			= $racetrack->getNumberOfLaps('R2');

		$header			= $teamlap->getRacingHeader();
		// $headerfirstpart	= $teamlap->getRacingHeaderFirstpart();
		// $headersecondpart	= $teamlap->getRacingHeaderSecondpart();
		$subheader		= $teamlap->getRacingSubHeader();

		$r1table 		= $teamlap->getRacingTable('R1');
		$r2table 		= $teamlap->getRacingTable('R2');
		$standardtable 	= $teamlap->getRacingTable('Standard');

		$data = [
			"header"		=> $header,
			"subheader"		=> $subheader,
			"r1table"		=> $r1table,
			"r2table"		=> $r2table,
			"standardtable"	=> $standardtable
		];

		return view('welcome', $data);
		// return view('data.testrange', $data);
	}
}
