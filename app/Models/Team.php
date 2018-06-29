<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\Models\Teamlap as Teamlap;

class Team extends Model
{
	use SoftDeletes;

	protected $fillable = ['name','carbrand', 'no', 'class'];


    public function getAll() {
		return $this::all();
	}

	public function getThisTeam($teamid) {
		// Get both soft deleted and not soft deleted teams
		return $this::withTrashed()->where('id', $teamid)->get();
	}

	/**
	* Insert team
	*
	* @param Array $teams - [0 => ['no' => no, 'name' => name, 'carbrand' => carbrand], 1 => [... ],...]
	*
	* @return void
	*/
	public function insertTeams($teams) {
		$teamlap = new Teamlap();
		// $teamlap::truncate();

		$this->reset();

		for($i = 1; $i < count($teams['no']); $i++) {
			$teams['teamtagg'] = $teams['no'][$i] . $teams['class'][$i];
			$teamid = $this::insertGetId(
			    		[
							'teamtagg'	=> $teams['teamtagg'],
							'name' 		=> $teams['name'][$i],
							'carbrand'	=> $teams['carbrand'][$i],
							'no' 		=> $teams['no'][$i],
							'class' 	=> $teams['class'][$i],
						]
					);
			$teams['id'] = $teamid;
			$teamlap->setNewTeamlaps($teams);
		}
	}

	public function reset() {
		$res = $this::all();

		foreach($res as $row) {
			$row->delete();
		}
	}

	/**
	* Insert team
	*
	* @param Array $teams - [0 => ['no' => no, 'name' => name, 'carbrand' => carbrand], 1 => [... ],...]
	*
	* @return void
	*/
	public function insertOneTeam($teams) {
		$teamlap = new Teamlap();
		$teams['teamtagg'] = $teams['no'] . $teams['class'];
		$teamid = $this::insertGetId(
			    		[
							'teamtagg'	=> $teams['teamtagg'],
							'name' 		=> $teams['name'],
							'carbrand'	=> $teams['carbrand'],
							'no' 		=> $teams['no'],
							'class' 	=> $teams['class'],
						]
					);
		$teams['id'] = $teamid;

		$teamlap->setNewTeamlaps($teams);
	}

	public function inputTeams($teamimport) {
		$teaminputs = [];
		$teaminputdata = [];
		$keys = ['name', 'carbrand', 'no', 'class'];

		foreach($teamimport as $row) {
			// BREAK UP THE ROW TO AN ARRAY
			$rowdata = explode(",", $row);
			if(count($rowdata) == count($keys)) {
				// THE LENGTH MUST BE THE SAME
				for($i = 0; $i < count($keys); $i++) {
					// FILL UP DATA FOR THAT ROW
					$teaminputdata[$keys[$i]] = $rowdata[$i];
				}
				// PUT DATA IN INPUTARRAY
				$teaminputs[] = $teaminputdata;
			}
		}
		return $teaminputs;
	}

	public function updateTeam($id, $field, $newvalue) {
		$this::where('id', $id)
          ->update([$field => $newvalue]);
		$team = $this::find($id);
		$class = $team->class;
		$no = $team->no;
		$tagg = $no . $class;
		$team->teamtagg = $tagg;
		$team->save();
	}

	public function deleteTeam($id) {
		$this::where('id', $id)->delete();
	}

	public function getByField($field, $value) {
		return $this::where($field, $value)->get();
	}

	public function getIdNotDeletedByTeamtagg($teamtagg) {
		$teamid = -1;
		$res = $this::where('teamtagg', $teamtagg)
						->where('deleted_at', null)
						->get();

		foreach($res as $row) {
			$teamid = $row->id;
		}
		return $teamid;

	}
}
