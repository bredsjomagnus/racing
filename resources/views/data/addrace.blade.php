@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
	<div class="newraceform">
		<center><h2>LÄGG TILL ETT RACE</h2></center>
		<form action="{{ route('addraceprocess' )}}" method="post">
			<ul>
				<li>
					<input type="text" name="place" placeholder="Plats">
					<span>Ange plats för racet här</span>
				</li>
				<li>
					<input type="date" name="date" placeholder='Datum'>
					<span>Ange datum för racet här</span>
				</li>
				<li>
					<input type="text" name="weather" placeholder="Väder">
					<span>Ange någon rad om vädret här</span>
				</li>
				<li>
					<input class='form-control' type="number" name="temp" min='-50' max='50' placeholder="Temperatur">
					<span>Ange temperatur vid racet här. Ett värde mellan -50 till 50 grader.</span>
				</li>
			</ul>
			<input class='btn btn-primary btn-sm' type="submit" name="addracebtn" value="Lägg till race">
		</form>
	</div>
@endsection
