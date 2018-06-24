<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mylapsdata as Mylapsdata;
use App\Models\Race as Race;

class Racetrack extends Model
{
	/**
	* Get races count of stored track datas for a certain type (mylaps or hard card)
	*
	* @param object every race
	* @param string datatype 'mylaps' or 'hardcard'
	*
	* @return array [raceid => count, ...] for datatype
	*/
	public function getAllTrackDataInfoByRace($races, $datatype) {
		// $mylapsdata = new Mylapsdata();
		$trackdataids = [];
		foreach($races as $race) {
			$trackdataids[$race->id] = $this::where('raceid', $race->id)->where('datatype', $datatype)->count();
		}

		return $trackdataids;
	}

	/**
	* Get races count of stored track datas for a certain type (mylaps or hard card)
	*
	* @param object every race
	* @param string datatype 'mylaps' or 'hardcard'
	*
	* @return array [raceid => count, ...] for datatype
	*/
	public function getOneTrackDataCount($raceid, $datatype) {
		// $mylapsdata = new Mylapsdata();
		$trackdataids = [];
		$trackdataids[$raceid] = $this::where('raceid', $raceid)->where('datatype', $datatype)->count();
		return $trackdataids;
	}


	public function getTrackDataByRaceId($raceid) {
		return $this::where('raceid', $raceid)->get();
	}

	public function getNumberOfLaps($class) {
		$race = new Race();


		$res2 = DB::table('teams')
						->where('class', $class)
						->get();

		foreach($res2 as $row) {
			$teams[$row->teamtagg] = [
										"name"		=> $row->name,
										"carbrand"	=> $row->carbrand
									];
		}

		$races = $race->getAll();
		$arr = [];
		$arr2 = [];
		foreach($races as $race) {
			foreach($res2 as $row) {
				$res = DB::table('mylapsview')
								->where('raceid', $race->id)
								->where('teamtagg', $row->teamtagg)
								->count();
				$arr[$row->teamtagg] = $res;
			}
			$arr2[$race->id] = $arr;
		}

		ksort($arr2);

		return $arr2;
	}
}
