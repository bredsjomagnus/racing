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
			"trackdata"			=> [],
		];
		return view('data.addtrackdata', $data);
	}

	public function addTrackDataProcess() {
		// $trackdata			= new Trackdata();
		// PHP_EOL build array with End Of Line as delimiter
		// array_filter trims array so that empty elements is removed
		$file 				= file_get_contents($_FILES['file']['tmp_name']);
		$csvarray 			= explode(PHP_EOL, $file);
		// $csvarray 			= explode(',', $file);

		/*----------------------------*/
		$trackdata	= array_filter($csvarray); // en rå array med varje rad som en string för filen per index.

		// Skapa en assocciativ array för inputfältet.
		$trackinputs = inputTracks($trackdata);

		$data = [
			"trackdata"			=> $trackdata,
		];
		return view('data.addtrackdata', $data);
	}
}
