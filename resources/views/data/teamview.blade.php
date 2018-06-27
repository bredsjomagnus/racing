@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')

	<h2 class="bluerow">{{$thisteam[0]->name}}</h2>
	<i>Raceid: {{ $raceid }}</i>

	<div class="row">
		<div id='chart-area'></div>

	</div>

@endsection
