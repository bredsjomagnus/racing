<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trackdata extends Model
{
    public function inputTracks($trackarray) {
		$trackinputs = [];
		$trackinputdata = [];
		$keys = ['#', 'name', 'lap_time', 'speed', 'elapsed_time', 'passing_time', 'hits', 'strength', 'noice', 'photocell_time', 'transponder', 'backup_tx', 'backup_passing_time'];

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

	/**
	* Insert values into trackdatas via .csv
	*
	* @param $inputs - assocciativ array with all names, speed and so on.
	* keys: name, speed,lap_time, elapsed_time, passing_time, hits, strength, noice, photocell_time, transponder, backup_tx, backup_passing_time
	* ["name" => [names...], "speed" => [speeds...], ...]
	*
	* @return void
	*/
	public function insertTrackDataViaArrays($inputs) {
		// str_replace(",",".",$inputs['speed'][$i]),
		for($i = 1; $i < count($inputs['name']); $i++) {
			$this::insert(
			    [
					'name' 					=> $inputs['name'][$i],
					'speed'	 				=> (float)str_replace(",",".",$inputs['speed'][$i]),
					'lap_time' 				=> $inputs['lap_time'][$i],
					'elapsed_time'		 	=> $inputs['elapsed_time'][$i],
					'passing_time'		 	=> $inputs['passing_time'][$i],
					'hits' 					=> $inputs['hits'][$i],
					'strength' 				=> $inputs['strength'][$i],
					'noice' 				=> $inputs['noice'][$i],
					'photocell_time' 		=> $inputs['photocell_time'][$i],
					'transponder' 			=> $inputs['transponder'][$i],
					'backup_tx' 			=> $inputs['backup_tx'][$i],
					'backup_passing_time' 	=> $inputs['backup_passing_time'][$i]
				]
			);
		}
	}

	public function getNumberOfRows() {
		return $this::get()->count();
	}

	public function getAllTrackData() {
		$res = $this::all();

		return $res;
	}
}
