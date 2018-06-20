<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
	protected $fillable = ['name','carbrand', 'no', 'class'];
    public function getAll() {
		return $this::all();
	}

	/**
	* Insert team
	*
	* @param Array $teams - [0 => ['no' => no, 'name' => name, 'carbrand' => carbrand], 1 => [... ],...]
	*
	* @return void
	*/
	public function insertTeams($teams) {
		$this::truncate();
		for($i = 1; $i < count($teams['no']); $i++) {
			$this::insert(
			    		[
							'name' 		=> $teams['name'][$i],
							'carbrand'	=> $teams['carbrand'][$i],
							'no' 		=> $teams['no'][$i],
							'class' 	=> $teams['class'][$i],
						]
					);
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
			$this::insert(
			    		[
							'name' 		=> $teams['name'],
							'carbrand'	=> $teams['carbrand'],
							'no' 		=> $teams['no'],
							'class' 	=> $teams['class'],
						]
					);
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
	}

	public function deleteTeam($id) {
		$this::where('id', $id)->delete();
	}
}
