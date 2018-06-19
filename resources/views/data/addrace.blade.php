@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
<div id='newraceform'>


	<div class="newraceform">
		<center><h2>LÄGG TILL ETT RACE</h2></center>
		<form action="{{ route('addraceprocess' )}}" method="post">
			<ul>
				<li>
					<input type="text" name="place" placeholder="Plats" v-model='placeInput' required>
					<span :class="inputClass">Ange plats för racet. Måste fyllas i.</span>
				</li>
				<li>
					<input type="date" name="date" placeholder='Datum' v-model='dateInput' required>
					<span :class="dateClass">Ange datum för racet. Måste fyllas i.</span>
				</li>
				<li>
					<input type="text" name="weather" placeholder="Väder">
					<span>Ange någon rad om vädret.</span>
				</li>
				<li>
					<input class='form-control' type="number" name="temp" min='-50' max='50' placeholder="Temperatur">
					<span>Ange temperatur vid racet här. Ett värde mellan -50 till 50 grader.</span>
				</li>
			</ul>
			<input class='btn btn-primary btn-sm' type="submit" name="addracebtn" value="Lägg till race">
		</form>
	</div>
</div>
@endsection
