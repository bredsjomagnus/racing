@extends('layouts.frontsidelayout')

@section('title', 'Trackdata')

@section('content')
	<h2>{{$race->place}} <small>{{substr($race->date, 0, 10)}}</small></h2>
	<div class="row">
		<div class="col-md-12">
			@if(strtolower($race->place) == 'mantorp')
			<p class='text-muted'>
				Mantorp Park har sedan starten 1969 varit en av Sveriges ledande motorbanor.
			</p>
			<p class='text-muted'>
				Från <a href='https://sv.wikipedia.org/wiki/Mantorp_Park'>wikipedia</a>:<br>
				Banan har tre bansträckningar, plus en dragstrip. En av bansträckningarna används dock inte.
				Den kortaste varianten av banan är 1 868 meter lång. Den längsta varianten av banan är 3 106 meter lång.
			</p>
			@elseif(strtolower($race->place) == 'sviestad')
			<p class='text-muted'>
				Linköpings Motorstadion, även kallad Sviestad, är en trafikövningsplats och motorsportanläggning belägen utanför Linköping, Sverige anläggningen ägs och drivs av Linköpings Motorsällskap.
			</p>
			<p class='text-muted'>
				Från <a href='https://sv.wikipedia.org/wiki/Link%C3%B6pings_Motorstadion'>wikipedia</a>:<br>
				Bansträckningen som används till bilracing mäter 2 137 meter och har ett banrekord på 65 sekunder, bansträckningen för MC är 2 160 meter och har banrekord på 54 sekunder...
			</p>
			@endif
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-5">
			<div id='raceview-area'></div>
		</div>
		<div class="col-md-7">
			<h4>Sammanställning</h4>
			<i class='text-muted'>
				Observera att enbart lag som är inlagda i databasen finns med i den data som visas.
			</i>
			<p class='text-muted'>
				Detta är en sammanställning för detta racet. Klicka på ett av lagen för att se sammanställning för just det laget kopplat till detta racet.
			</p>
			<p>Då hastighet inte finns med i 'hard card'-tabellerna saknas den informationen race med den sortens track data.</p>
			<table class='table table-striped'>

					<thead>
						<tr class='resulttableheader'>
							<th>Team</th>
							<th><center>Högsta hastighet</center></th>
						</tr>
					</thead>


				<tbody>
					@foreach($fastestlaps as $fastrow)
                        <tr>
                            <td><a href="#">{{$fastrow['name']}}</a></td>
                            <td><center>{{$fastrow['maxspeed']}} {{$fastrow['maxspeed'] == 'Saknas för Hard Card' ? '' : 'km/h' }}</center></td>
                        </tr>
                    @endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection
