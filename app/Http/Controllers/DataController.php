<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mylapsdata as Mylapsdata;
use App\Models\Hardcarddata as Hardcarddata;
use App\Models\Race as Race;

class DataController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function addMylapsData(Request $request) {
		$race 	= new Race();

		$races 	= $race->getAll();

		$raceid = $request->input('raceid');

		if(!isset($raceid)){
			$raceid = 1;
		}

		$data = [
			"trackinputs"	=> [],
			"races"			=> $races,
			"raceid"		=> $raceid
		];
		return view('data.addmylapsdata', $data);
	}

	public function addHardcardData(Request $request) {
		$race 	= new Race();

		$races 	= $race->getAll();

		$raceid = $request->input('raceid');

		if(!isset($raceid)){
			$raceid = 1;
		}

		$data = [
			"trackinputs"	=> [],
			"races"			=> $races,
			"raceid"		=> $raceid
		];
		return view('data.addhardcarddata', $data);
	}

	public function addMylapsDataConfirm(Request $request) {
		$mylapsdata 		= new Mylapsdata();
		$race				= new Race();
		$filename = $_FILES['file']['name'];
		// $Mylapsdata			= new Mylapsdata();
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
		$trackinputs 	= $mylapsdata->inputTracks($trackimport); // [0 => ['name' = namn, 'speed' => speed,....],...]

		$data = [
			"filename"		=> $filename,
			"trackinputs"	=> $trackinputs,
			"races"			=> $races,
			"raceid"		=> $raceid,
			"raceinfo"		=> $raceinfo
		];
		return view('data.addmylapsdata', $data);
	}

	public function addHardcardDataConfirm(Request $request) {
		$hardcarddata 		= new Hardcarddata();
		$race				= new Race();
		$filename = $_FILES['file']['name'];
		// $Mylapsdata			= new Mylapsdata();
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
		$trackinputs 	= $hardcarddata->inputTracks($trackimport); // [0 => ['name' = namn, 'speed' => speed,....],...]

		$data = [
			"csvarray"		=> $csvarray,
			"filename"		=> $filename,
			"trackinputs"	=> $trackinputs,
			"races"			=> $races,
			"raceid"		=> $raceid,
			"raceinfo"		=> $raceinfo
		];
		return view('data.addhardcarddata', $data);
	}

	public function addMylapsDataProcess(Request $request) {
		$mylapsdata 					= new Mylapsdata();

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

		$mylapsdata->insertMylapsDataViaArrays($inputs, $raceid);
		// $data = [
		// 	"inputs"	=> $inputs
		// ];
		return redirect('/home');
	}

	public function addHardcardDataProcess(Request $request) {
		$hardcarddata 				= new Hardcarddata();

		$inputs = [];
		$inputs['tagid'] 				= $request->input('tagid');
		$inputs['frequency'] 			= $request->input('frequency');
		$inputs['signalstrength'] 		= $request->input('signalstrength');
		$inputs['antenna'] 				= $request->input('antenna');
		$inputs['time'] 				= $request->input('time');
		$inputs['datetime'] 			= $request->input('datetime');
		$inputs['hits'] 				= $request->input('hits');
		$inputs['competitorid'] 		= $request->input('competitorid');
		$inputs['competitionnumber']	= $request->input('competitionnumber');
		$inputs['firstname'] 			= $request->input('firstname');
		$inputs['lastname'] 			= $request->input('lastname');
		$inputs['lap_time'] 			= $request->input('lap_time');
		$inputs['deleted'] 				= $request->input('deleted');
		$raceid 						= $request->input('raceid');

		$hardcarddata->insertHardcardDataViaArrays($inputs, $raceid);
		// $data = [
		// 	"inputs"	=> $inputs
		// ];
		return redirect('/home');
	}

	public function editMylapsData($id) {

		return view('data.editmylaps');
	}

	public function editHardcardData($id) {

		return view('data.edithardcard');
	}

	public function addRace() {

		$data = [

		];
		return view('data.addrace', $data);
	}

	public function deleteRace($id){
		$race = new Race();
		$race->deleteRace($id);

		return redirect('/home');
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
