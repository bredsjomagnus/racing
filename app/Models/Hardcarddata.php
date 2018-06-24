<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hardcarddata extends Model
{
	public function inputTracks($trackarray) {
		$trackinputs = [];
		$trackinputdata = [];
		$keys = ['tagid', 'frequency', 'signalstrength', 'antenna', 'time', 'datetime', 'hits', 'competitorid', 'competitionnumber', 'firstname', 'lastname', 'lap_time', 'deleted'];

		foreach($trackarray as $trackrow) {
			// BREAK UP THE ROW TO AN ARRAY
			$rowdata = explode(";", $trackrow);
			if(count($rowdata) == count($keys)) {
				// THE LENGTH MUST BE THE SAME
				for($i = 0; $i < count($keys); $i++) {
					// FILL UP DATA FOR THAT ROW
					$trackinputdata[$keys[$i]] = $rowdata[$i];
				}
				// PUT DATA IN INPUTARRAY
				$trackinputs[] = $trackinputdata;
			}
		}
		return $trackinputs;
	}

	public function insertHardcardDataViaArrays($inputs, $raceid, $class) {
		$racetrack 	= new Racetrack();
		$team 		= new Team();
		// str_replace(",",".",$inputs['speed'][$i]),
		for($i = 1; $i < count($inputs['tagid']); $i++) {
			$teamtagg = $inputs['competitionnumber'][$i] . $class;
			$teamid = $team->getIdNotDeletedByTeamtagg($teamtagg);
			$trackdataid = $this::insertGetId(
			    		[
							'tagid' 			=> $inputs['tagid'][$i],
							'frequency' 		=> $inputs['frequency'][$i],
							'signalstrength' 	=> $inputs['signalstrength'][$i],
							'antenna' 			=> $inputs['antenna'][$i],
							'time' 				=> $inputs['time'][$i],
							'datetime'	 		=> $inputs['datetime'][$i],
							'hits' 				=> $inputs['hits'][$i],
							'competitorid' 		=> $inputs['competitorid'][$i],
							'competitionnumber'	=> $inputs['competitionnumber'][$i],
							'firstname' 		=> $inputs['firstname'][$i],
							'lastname' 			=> $inputs['lastname'][$i],
							'lap_time' 			=> $inputs['lap_time'][$i],
							'deleted' 			=> $inputs['deleted'][$i],
							'raceid'			=> $raceid,
							'class'				=> $class,
							'teamid'			=> $teamid,
							'teamtagg'			=> $teamtagg
						]
					);
			$racetrack::insert([
							'raceid'				=> $raceid,
							'hardcardid'			=> $trackdataid,
							'datatype'				=> 'hardcard'
						]);
		}
	}
}
