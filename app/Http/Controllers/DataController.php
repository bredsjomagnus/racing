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
		$inputs['name'] 			= $request->input('name');
		$inputs['speed'] 			= $request->input('speed');
		$inputs['lap_time'] 		= $request->input('lap_time');
		$inputs['elapsed_time'] 	= $request->input('elapsed_time');
		$inputs['passing_time'] 	= $request->input('passing_time');
		$inputs['hits'] 			= $request->input('hits');
		$inputs['strength'] 		= $request->input('strength');
		$inputs['noice'] 			= $request->input('noice');
		$inputs['photocell_time'] 	= $request->input('photocell_time');
		$inputs['transponder'] 		= $request->input('transponder');
		$inputs['backup_tx']	 	= $request->input('backup_tx');
		$inputs['backup_passing_time'] = $request->input('backup_passing_time');

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
