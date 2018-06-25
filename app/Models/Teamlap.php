<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\Models\Team as Team;
use App\Models\Race as Race;
use App\Models\Racetrack as Racetrack;

class Teamlap extends Model
{
    public function addTeamLaps($raceid) {
		$team 		= new Team();
		$race 		= new Race();
		$racetrack	= new Racetrack();

		$teams 	= $team->getAll();

		/*	FÖR ATT KUNNA HANTERA ATT ANVÄNDAREN LÄGGER TILL NYA TRACKS ELER
		*	REDIGERAR REDAN INLAGDA DATA MÅSTE TEAMLAPS FÖRST RESAS FÖR JUST
		* 	DETTA RACET FÖR ATT SEDAN KUNNA FYLLAS PÅ NY KORREKT DATA.
		*	KOLLA DÄREFTER VAD DETTA RACET HAR MEST AV; MYLAPS ELLER HARD CARD.
		* 	ANVÄND SEDAN DÄREFTER DET FORMAT SOM DET FINNS MEST AV OCH LÄGG IN
		*	I TEAMLAPS.
		*/
		$this->reset($raceid);
		// $thisrace = $race->getRace($raceid);
		$mylapsdatacount = $racetrack->getOneTrackDataCount($raceid, 'mylaps');
		$hardcarddatacount = $racetrack->getOneTrackDataCount($raceid, 'hardcard');

		$mylapsbigger = $mylapsdatacount[$raceid] >= $hardcarddatacount[$raceid];

		$laps = -1;
		foreach($teams as $row) {
			/*	BEROENDE PÅ VILKET FORMAT AV TRACKSDATA SOM DET FINNS MEST AV
			*	LÄGG TILL ANTALET LAPS FÖR VARJE TEAM I JUST DETTA RACET (raceid)
			*	BYGGT PÅ ANTALET RADER I mylapsview RESP. hardcardview.
			*/
			if($mylapsbigger) {
				$laps 	= DB::table('mylapsview')
									->where('raceid', $raceid)
									->where('teamid', $row->id)
									->count();
			} else {
				$laps 	= DB::table('hardcardview')
									->where('raceid', $raceid)
									->where('teamid', $row->id)
									->count();
			}

			$this::insert([
				"teamid"	=> $row->id,
				"teamname"	=> $row->name,
				"carbrand"	=> $row->carbrand,
				"raceid"	=> $raceid,
				"teamtagg"	=> $row->teamtagg,
				"laps"		=> $laps,
				"class"		=> $row->class
			]);
		}

	}

	public function getRacingTable($class) {
		$race = new Race();
		$team = new Team();
		$races = $race->getAll();

		// SELECT teamid, SUM(laps) AS sumlaps FROM teamlaps WHERE class = 'R1' GROUP BY teamid ORDER BY sumlaps DESC;

		$sortedteams = DB::select(
						DB::raw(
							"SELECT teamid, SUM(laps) AS sumlaps FROM teamlaps WHERE class = '".$class."' GROUP BY teamid ORDER BY sumlaps DESC"
							));

		// $teamsbyclass = $team->getByField('class', $class);

		$r1table = [];
		$rownumber = 1;
		foreach($sortedteams as $st) {
			$teambyid = $team->getByField('id', $st->teamid);
			foreach($teambyid as $tc) {
				$tccontent = [];
				$tccontent[] = $tc->no;
				$tccontent[] = $tc->name;
				$tccontent[] = $tc->carbrand;

				foreach($races as $ra) {
					$tls = $this::where('raceid', $ra->id)
							->where('teamid', $tc->id)
							->where('class', $class)
							->get();
					foreach($tls as $tl) {
						$tccontent[] = $tl->laps;
					}
				}
				$tccontent[] = $st->sumlaps;
				$r1table[$rownumber] = $tccontent;
				$rownumber++;
			}
		}
		return $r1table;
	}

	/**
	* Delete varje rad för ett race.
	*
	* @param integer race id.
	*
	* @return void
	*/
	public function reset($raceid) {
		$res = $this::where('raceid', $raceid)->get();

		foreach($res as $row) {
			$row->delete();
		}
	}

	public function getRacingHeader() {
		$race = new Race();
		$races = $race->getAll();

		/*-------------------------------*/

		$header = ['Pos', 'No', 'Team', 'Bilmärke'];
		foreach($races as $racerow) {
			$header[] = $racerow->place;
		}
		$header[] =  'Summa';
		return $header;
	}

	// public function getRacingHeaderFirstpart() {
	//
	// 	/*-------------------------------*/
	//
	// 	$header = ['Pos', 'No', 'Team', 'Bilmärke'];
	//
	// 	return $header;
	// }
	//
	// public function getRacingHeaderSecondpart() {
	// 	$race = new Race();
	// 	$races = $race->getAll();
	//
	// 	/*-------------------------------*/
	//
	// 	foreach($races as $racerow) {
	// 		$header[] = $racerow->place;
	// 	}
	// 	$header[] =  'Summa';
	// 	return $header;
	// }


	public function getRacingSubHeader() {
		$race = new Race();
		$races = $race->getAll();

		/*-------------------------------*/

		$subheader = ['', '', '', ''];
		foreach($races as $racerow) {
			$subheader[] = substr($racerow->date, 0, 10);
		}
		$subheader[] =  '';
		return $subheader;
	}

	public function setNewTeamlaps($teamarray) {
		$race = new Race();
		$res = $race->getAll();
		foreach($res as $row) {
			$this::insert([
				"teamid"	=> $teamarray['id'],
				"teamname"	=> $teamarray['name'],
				"carbrand"	=> $teamarray['carbrand'],
				"raceid"	=> $row->id,
				"teamtagg"	=> $teamarray['teamtagg'],
				"laps"		=> 0,
				"class"		=> $teamarray['class']
			]);
		}
	}
}
