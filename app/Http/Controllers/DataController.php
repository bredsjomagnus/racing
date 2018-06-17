<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trackdata as Trackdata;
use App\Models\Race as Race;

class DataController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function addTrackData() {
		$race = new Race();

		$races = $race->getAll();

		$data = [
			"trackinputs"	=> [],
			"races"			=> $races,
			"raceid"		=> 1
		];
		return view('data.addtrackdata', $data);
	}

	public function addTrackDataConfirm(Request $request) {
		$trackdata 		= new Trackdata();
		$race			= new Race();
		// $trackdata			= new Trackdata();
		// PHP_EOL build array with End Of Line as delimiter
		// array_filter trims array so that empty elements is removed
		$file 			= file_get_contents($_FILES['file']['tmp_name']);
		$csvarray 		= explode(PHP_EOL, $file);
		// $csvarray 			= explode(',', $file);

		/*----------------------------*/

		$races			= $race->getAll();
		$raceid 		= $request->input('raceid');
		$raceinfo 		= $race->getRace($raceid);
		$trackimport	= array_filter($csvarray); // en rå array med varje rad som en string för filen per index.

		// Skapa en assocciativ array för inputfältet.
		$trackinputs 	= $trackdata->inputTracks($trackimport); // [0 => ['name' = namn, 'speed' => speed,....],...]

		$data = [
			"trackinputs"	=> $trackinputs,
			"races"			=> $races,
			"raceid"		=> $raceid,
			"raceinfo"		=> $raceinfo
		];
		return view('data.addtrackdata', $data);
	}

	public function addTrackDataProcess(Request $request) {
		$trackdata 					= new Trackdata();

		$inputs = [];
		$inputs['no'] 				= $request->input('no');
		$inputs['name'] 			= $request->input('name');
		$inputs['laps'] 			= $request->input('laps');
		$inputs['lead'] 			= $request->input('lead');
		$inputs['lap_time'] 		= $request->input('lap_time');
		$inputs['speed'] 			= $request->input('speed');
		$inputs['elapsed_time'] 	= $request->input('elapsed_time');
		$inputs['passing_time'] 	= $request->input('passing_time');
		$inputs['hits'] 			= $request->input('hits');
		$inputs['strength'] 		= $request->input('strength');
		$inputs['noice'] 			= $request->input('noice');
		$inputs['photocell_time'] 	= $request->input('photocell_time');
		$inputs['transponder'] 		= $request->input('transponder');
		$inputs['backup_tx']	 	= $request->input('backup_tx');
		$inputs['backup_passing_time'] = $request->input('backup_passing_time');
		$inputs['class'] 			= $request->input('class');
		$inputs['deleted'] 			= $request->input('deleted');
		$raceid 					= $request->input('raceid');

		$trackdata->insertTrackDataViaArrays($inputs, $raceid);
		// $data = [
		// 	"inputs"	=> $inputs
		// ];
		return redirect('/home');
	}

	public function editTrackData($id) {
		$trackdata		= new Trackdata();

		$res			= $trackdata->getAllTrackDataByRace($id);

		$data = [
			"res"	=> $res
		];

		return view('data.edit', $data);
	}

	public function addRace() {

		$data = [

		];
		return view('data.addrace', $data);
	}

	public function addRaceProcess(Request $request) {
		$race 				= new Race();
		$inputs['place'] 	= $request->input('place');
		$inputs['date'] 	= $request->input('date');
		$inputs['weather'] 	= $request->input('weather');
		$inputs['temp'] 	= $request->input('temp');

		if(isset($inputs['place']) && trim($inputs['place']) != '' && isset($inputs['date'])) {
			$race->addRace($inputs);
			return redirect('/home');
		} else {
			return redirect('/data/addrace');
		}




	}
}
