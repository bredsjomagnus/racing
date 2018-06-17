@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
<br>
<br>
<br>
<a role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Läs mer om att lägga till via csv-fil...
</a>
<div class="collapse" id="collapseExample">
  <div class="well">
	  <h4>  LÄGG TILL TRACKDATA VIA CSV-fil</h4>
  	<div class="row">
  		<div class="col-md-12">
  			<h5>CSV</h5>
  			<p class='text-muted'>För att lägga till via csv-fil måste filen hålla en viss struktur för att servern skall kunna bearbeta informationen och kunna lägga ner den i databasen.</p>
  			<h5>RACE</h5>
  			<p class='text-muted'>
  				Trackdata kopplas till ett race så därför måste det racet redan vara inlagt. Välj vilket race som trackdatan skall kopplas till eller klicka vidare på <a href="{{ route('addrace')}}" >lägg till race</a> för att skapa det först.
  			</p>
  			<h5>HEADER</h5>
  			<!-- <img src="{{ asset('img/csvheader.png') }}" alt="csv header"> -->
  			<p class='text-muted'>Översta raden måste innehålla rubrikerna för de olika kolumnerna. Det är inte viktigt exakt vad det står (svenska eller engelska). Men följande kolumner skall finnas och i denna ordningen:</p>
  		</div>
  		<div class='col-md-12'>
  			<p class='text-muted'><i>#, no, name, laps, lead, lap time, speed, elapsed time, passed time, hits, strength, noice, photocell time, transponder, backup_tx, backup_passing_time, class, deleted</i></p>
  			<h5>SEPARATOR</h5>
  			<!-- <img src="{{ asset('img/semikoloncsv.png') }}" alt="csv header"> -->
  			<p class='text-muted'>När man skapar en csv-fil kan det ibland väljas hur de olika värdena skall seprareras. Det är viktigt att man här väljer komma som separator för att servern skall kunna behandla och spara ner filen i databasen.</p>
  		</div>
  </div>
</div>
</div>


		<hr>
<div class="row">
		<div class="col-md-12">
			<table width="600px">
				<form action="{{ route('addtrackdataconfirm') }}" method="post" enctype="multipart/form-data">
					@csrf
					<tr>
						<td>Välj race:</td>
						<td>
							<select id='raceid' name="raceid">
								@foreach($races as $race)
									<option value={{$race->id}} {{$raceid == $race->id ? 'selected' : ''}}>{{substr($race->date, 0, 10)}} - {{$race->place}}</option>
								@endforeach
							</select>
							@if(count($races) < 1)
								&nbsp;&nbsp;&nbsp;<i class='text-danger'>Det finns inga race inlagda. <a href="{{ route('addrace')}}" >Lägg till ett race här</a>.</i>
							@else
								Saknas racet? <a href="{{ route('addrace')}}" >Lägg till här</a>.
							@endif
						</td>
					</tr>
					<tr>
						<td width="20%">Välj fil</td>
						<td width="80%"><input class='btn btn-default' type="file" name="file" id="file" onchange="validateFile()" /></td>
					</tr>

					<tr>
						<td></td>
						<td><input class='btn btn-primary' type="submit" name="submit" value='Importera' id='importera' /></td>
					</tr>
				</form>
			</table>

		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<br>
			@if(count($trackinputs) > 0)
				<h2>Mylaps {{count($trackinputs) - 1}} rader [Race: {{$raceinfo->date}} - {{$raceinfo->place}}]</h2>
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
					<input type="hidden" name="raceid" value="{{$raceid}}">
					</table>
				</form>
			@endif
		</div>
	</div>






@endsection
