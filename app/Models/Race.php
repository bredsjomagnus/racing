<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mylapsdata as Mylapsdata;
use App\Models\Hardcarddata as Hardcarddata;
use App\Models\Racetrack as Racetrack;

class Race extends Model
{
    public function getAll() {
		return $this::all()->sortBy('date');
	}

	public function addRace($inputs) {
		$this::insert([
					'place' 	=> $inputs['place'],
					'date'		=> $inputs['date'],
					'weather'	=> $inputs['weather'],
					'temp'		=> $inputs['temp']
				]);
	}

	public function getRace($raceid) {
		return $this::find($raceid);
	}

	public function deleteRace($raceid) {
		// $mylapsdata = new Mylapsdata();
		Racetrack::where('raceid', $raceid)->delete();
		Mylapsdata::where('raceid', $raceid)->delete();
		Hardcarddata::where('raceid', $raceid)->delete();
		$this::where('id', $raceid)->delete();
	}
}
