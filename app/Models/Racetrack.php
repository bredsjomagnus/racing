<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mylapsdata as Mylapsdata;

class Racetrack extends Model
{
	public function getAllTrackDataInfoByRace($races, $datatype) {
		// $mylapsdata = new Mylapsdata();
		$trackdataids = [];
		foreach($races as $race) {
			$trackdataids[$race->id] = $this::where('raceid', $race->id)->where('datatype', $datatype)->count();
		}

		return $trackdataids;
	}

	public function getTrackDataByRaceId($raceid) {
		return $this::where('raceid', $raceid)->get();
	}
}
