<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Race as Race;
use App\Models\Team as Team;
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

		$width = '40%';
		if(isset($r1table[1])) {
			$widthnumber 	= 40 + 6*(count($r1table[1])-4);
			$widthnumber = $widthnumber > 100 ? 100 : $widthnumber;
			$width = $widthnumber ."%";
		}


		$data = [
			"width"			=> $width,
			"header"		=> $header,
			"subheader"		=> $subheader,
			"r1table"		=> $r1table,
			"r2table"		=> $r2table,
			"standardtable"	=> $standardtable
		];

		return view('welcome', $data);
		// return view('data.testrange', $data);
	}

	public function raceView($raceid) {
		$race 			= new Race();
		$team 			= new Team();

		$thisrace 		= $race->getRace($raceid);
		$teams			= $team->getAll();

		$fastestlaps 	= $race->getTeamsBestOfRace($raceid); // Array; [teamid => [maxspeed, name], ...]
		$data = [
			"race"			=> $thisrace,
			"teams"			=> $teams,
			"fastestlaps"	=> $fastestlaps
		];
		return view('data.raceview', $data);

	}
}
