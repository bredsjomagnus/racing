@extends('layouts.standard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<h3></h3>
		<p class='text-muted'>Inlagda race i databasen. Klicka länken för att se mer detaljer kring ett race.</p>
    </div>
	<div class="row">
		<?phh
		if(isset($inputs)) {
			var_dump($inputs);
		}
		?>
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
											@if(isset($race->weather) && isset($race->temp))
												{{ strlen($race->weather) > 20 ? substr($race->weather, 0 , 20).'...':$race->weather }}, {{ strlen($race->temp) > 0 ? $race->temp. ' '. 'grader' : '' }}
											@elseif(isset($race->weather))
												{{ strlen($race->weather) > 35 ? substr($race->weather, 0 , 35).'...':$race->weather}}
											@elseif(isset($race->temp))
												{{ $race->temp}}. ' grad'
											@else
												Info saknas
											@endif
										</i>
									</h6>
								</td>
							</tr>
							<tr>
								<td>

								</td>
							</tr>
							<tr>
								<td align='right' style='padding-right: 10px'>
									<?php $editmylapsdataurl = url('/data/edit/mylapsdata/'.$race->id); ?>
									<?php $edithardcarddataurl = url('/data/edit/hardcarddata/'.$race->id); ?>
									<a class="card-link" href="{{ $editmylapsdataurl }}">
										Mylaps
									</a>
									<span class="badge badge-primary">{{ $mylapsdataids[$race->id] }}</span>

									<span>&nbsp;&nbsp;</span>

									<a class="card-link" href="{{ $edithardcarddataurl }}">
										Hard Card
									</a>
									<span class="badge badge-primary">{{ $hardcarddataids[$race->id] }}</span>
								</td>
							</tr>
							<tr class="spacer"></tr>
							<tr class='racetoolsrow'>
								<td align='right'>
									<div class="racetools">
										<?php
										$addmylapsurl = url('/data/addmylapsdata?raceid='.$race->id);
										$addhardcardsurl = url('/data/addhardcarddata?raceid='.$race->id);
										?>
										<a href="{{ $addmylapsurl }}">+ Mylaps</a>
										<span>&nbsp;</span>
										<a href="{{ $addhardcardsurl }}">+ Hard Card</a>
										<span>&nbsp;</span>
										<?php $deleterace = url('/data/delete/race/'.$race->id); ?>
										<a href="{{ $deleterace }}" onclick='return confirm("Ta bort race med alla inlagda tracksdata?")'><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
									</div>
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
