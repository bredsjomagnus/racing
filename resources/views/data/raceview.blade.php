@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
	<h2>RACE - {{$race[0]->place}} {{substr($race[0]->date, 0, 10)}}</h2>
	<div class="row">
		<div id='raceview-area'></div>
	</div>

@endsection
