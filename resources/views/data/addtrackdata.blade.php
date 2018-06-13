@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
	<h1>LÄGG TILL TRACKDATA VIA CSV-fil</h1>
	<div class="row">
		<div class="col-md-4">
			<h2>CSV</h2>
			<p>För att lägga till via csv-fil måste filen hålla en viss struktur för att servern skall kunna bearbeta informationen och kunna lägga ner den i databasen.</p>
			<p>Översta raden måste innehålla rubrikerna för de olika kolumnerna. Det är inte viktigt exakt vad det står (svenska eller engelska). Men följande kolumner skall finnas och i denna ordningen:</p>
			<ul>
				<li>#</li>
				<li>Name</li>
				<li>Lap Time</li>
				<li>Speed</li>
				<li>Elapsed Time</li>
				<li>Passing Time</li>
				<li>Hits</li>
				<li>Strength</li>
				<li>Noice</li>
				<li>Photocell Time</li>
				<li>Transponder</li>
				<li>Background TX</li>
				<li>Background Passing Time</li>
			</ul>
			<h3>Semikolon som separator</h3>
			<p>När man skapar en csv-fil kan det ibland väljas hur de olika värdena skall seprareras. Det är viktigt att man här väljer semikolon (;) som separator för att servern skall kunna behandla och spara ner filen i databasen.</p>
		</div>
		<div class="col-md-8">
			<table width="600px">
				<form action="{{ route('addtrackdataconfirm') }}" method="post" enctype="multipart/form-data">
					@csrf
					<tr>
						<td width="20%">Välj fil</td>
						<td width="80%"><input type="file" name="file" id="file" onchange="validateFile()" /></td>
					</tr>

					<tr>
						<td></td>
						<td><input type="submit" name="submit" value='Importera' id='importera' /></td>
					</tr>
				</form>
			</table>
			<br>
			@if(count($trackinputs) > 0)
				<h2>Vill du lägga till följande data?</h2>
				<form action="{{ route('addtrackdataprocess') }}" method="post">
					<input class='btn btn-primary btn-small' type="submit" name="addtrackdatabtn" value="Lägg till trackdata">
					<br>
					<br>
					@csrf
					<table class='table'>
					@foreach($trackinputs as $row)
						<tr>
							@foreach($row as $key => $value)
								<td>{{htmlspecialchars($value)}}</td>
								<input type="hidden" name="{{$key}}[]" value="{{$value}}">
							@endforeach
						</tr>
					@endforeach
					</table>
				</form>
			@endif
		</div>
	</div>



@endsection
