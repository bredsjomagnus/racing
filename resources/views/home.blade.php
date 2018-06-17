@extends('layouts.standard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<h3>DASHBOARD</h3>
		<p>Inlagda race i databasen. Klicka länken för att se mer detaljer kring ett race.</p>
    </div>
	<div class="row">

		@foreach($races as $race)
			<div class="col-md-3">
				<div class="card">
					<div class="card-body">
						<table class='card-table'>
							<tr class='card-title-row'>
								<td>
									<center>
										<h4 class="card-title">{{ $race->place }} - <small> {{ substr($race->date, 0, 10) }} </small> </h4>
									</center>
								</td>
							</tr>
							<tr>
								<td>
									<h6 class="card-subtitle mb-2 text-muted">
										Väderinfo: <i class="card-subtitle mb-2 text-muted text-info">
										{{ $race->weather}} {{ strlen($race->temp) > 0 ? $race->temp. ' '. 'grad' : '' }}
										</i>
									</h6>
								</td>
							</tr>
							<tr>
								<td>

								</td>
							</tr>
							<tr>
								<td>
									<?php $edittrackurl = url('/data/edit/trackdata/'.$race->id); ?>
									<a class="card-link" href="{{ $edittrackurl }}">Trackdata <span class="badge">{{ $trackdataids[$race->id] }}</span></a>
								</td>
							</tr>
						</table>


						<p class="card-text"></p>

					</div>
				</div>
			</div>
		@endforeach


	</div>
</div>
@endsection
