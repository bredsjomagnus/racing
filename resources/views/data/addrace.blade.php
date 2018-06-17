@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
	<h1>LÄGG TILL RACE</h1>
	<form action="{{ route('addraceprocess' )}}" method="post">
		<table>
			<tr>
				<th>Plats*</th>
				<th>Datum*</th>
				<th>Väder</th>
				<th>Temperatur</th>
				<th></th>
			</tr>
			<tr>
				<td><input class='form-control' type="text" name="place" value="" placeholder=""></td>
				<td><input class='form-control' type="date" name="date" value=""></td>
				<td><input class='form-control' type="text" name="weather" value="" placeholder=""></td>
				<td><input class='form-control' type="number" name="temp" min='-50' max='50' value="" placeholder=""></td>
				<td><input class='btn btn-primary' type="submit" name="addracebtn" value="Lägg till race"></td>
			</tr>
		</table>
		<i>Plats och datum måste finnas med.</i>




	</form>
@endsection
