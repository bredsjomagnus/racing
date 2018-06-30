<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Mylapsdata as Mylapsdata;
use App\Models\Hardcarddata as Hardcarddata;
use App\Models\Racetrack as Racetrack;
use App\Models\Teamlap as Teamlap;

class Race extends Model
{
    public function getAll() {
		return $this::all()->sortBy('date');
	}

	public function addRace($inputs) {
		$teamlap = new Teamlap();
		$raceid = $this::insertGetId([
					'place' 	=> $inputs['place'],
					'date'		=> $inputs['date'],
					'weather'	=> $inputs['weather'],
					'temp'		=> $inputs['temp']
				]);
		$teamlap->addTeamLaps($raceid);
	}

	public function getRace($raceid) {
		return $this::find($raceid);
		// return $this::where("id", $raceid)->get();
	}

	public function getClass($class) {
		return $this::where('class', $class);
	}

	public function deleteRace($raceid) {
		// $mylapsdata = new Mylapsdata();
		Racetrack::where('raceid', $raceid)->delete();
		Mylapsdata::where('raceid', $raceid)->delete();
		Hardcarddata::where('raceid', $raceid)->delete();
		Teamlap::where('raceid', $raceid)->delete();
		$this::where('id', $raceid)->delete();
	}

	/**
	* Get one races fastes laps for all teams.
	*
	* @param integer race id
	*
	* @return array [teamid => [maxspeed, name], ...]
	*/
	public function getTeamsBestOfRace($raceid) {
		$team 		= new Team();
		$racetrack 		= new Racetrack();
		$mylapsdata 	= new Mylapsdata();
		$hardcarddata 	= new Hardcarddata();

		$mylapsdatacount = $racetrack->getOneTrackDataCount($raceid, 'mylaps');
		$hardcarddatacount = $racetrack->getOneTrackDataCount($raceid, 'hardcard');

		$mylapsbigger = $mylapsdatacount[$raceid] >= $hardcarddatacount[$raceid];


		$resultarray = [];
		if($mylapsbigger) {
			$res = DB::select(
					DB::raw(
						"SELECT DISTINCT MAX(speed) AS maxspeed, teamid FROM mylapsdatas WHERE raceid = ".$raceid." GROUP BY teamid ORDER BY maxspeed DESC"
					));
			foreach($res as $row) {
				$thisteam = $team->getThisTeam($row->teamid);
				foreach($thisteam as $t) {
					$resultarray[] = ['maxspeed' => $row->maxspeed, 'name' => $t->name, 'teamid' => $row->teamid];
				}

			}
		} else {
			$res = DB::select(
					DB::raw(
						"SELECT DISTINCT MAX(hits) AS maxspeed, teamid FROM hardcarddatas WHERE raceid = ".$raceid." GROUP BY teamid ORDER BY maxspeed DESC"
					));
			foreach($res as $row) {
				$thisteam = $team->getThisTeam($row->teamid);
				foreach($thisteam as $t) {
					$resultarray[] = ['maxspeed' => 'Saknas för Hard Card', 'name' => $t->name, 'teamid' => $row->teamid];
				}
			}
		}

		return $resultarray;
	}
}
