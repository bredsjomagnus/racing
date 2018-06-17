<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function getAll() {
		return $this::all();
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
}
