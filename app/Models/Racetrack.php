<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Trackdata as Trackdata;

class Racetrack extends Model
{
	public function getAllTrackDataInfoByRace($races) {
		$trackdata = new Trackdata();
		$trackdataids = [];
		foreach($races as $race) {
			$trackdataids[$race->id] = $this::where('raceid', $race->id)->count();
		}

		return $trackdataids;
	}

	public function getTrackDataByRaceId($raceid) {
		return $this::where('raceid', $raceid)->get();
	}
}
