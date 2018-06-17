<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trackdata as Trackdata;

class DataController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function addTrackData() {


		$data = [
			"trackinputs"			=> []
		];
		return view('data.addtrackdata', $data);
	}

	public function addTrackDataConfirm() {
		$trackdata 		= new Trackdata();
		// $trackdata			= new Trackdata();
		// PHP_EOL build array with End Of Line as delimiter
		// array_filter trims array so that empty elements is removed
		$file 			= file_get_contents($_FILES['file']['tmp_name']);
		$csvarray 		= explode(PHP_EOL, $file);
		// $csvarray 			= explode(',', $file);

		/*----------------------------*/

		$trackimport	= array_filter($csvarray); // en rå array med varje rad som en string för filen per index.

		// Skapa en assocciativ array för inputfältet.
		$trackinputs 	= $trackdata->inputTracks($trackimport); // [0 => ['name' = namn, 'speed' => speed,....],...]

		$data = [
			"trackinputs"	=> $trackinputs
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

		$trackdata->insertTrackDataViaArrays($inputs);
		// $data = [
		// 	"inputs"	=> $inputs
		// ];
		return redirect('/home');
	}

	public function editTrackData() {
		$trackdata		= new Trackdata();

		$res			= $trackdata->getAllTrackData();

		$data = [
			"res"	=> $res
		];

		return view('data.edit', $data);
	}
}
