@extends('layouts.standard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<h3>DASHBOARD</h3>
		<p>Detta blir yta för databasinformation.</p>
    </div>
	<div class="row">

		@foreach($races as $race)
			<div class="col-md-3">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h4 class="card-title">{{ $race->place }} - <small> {{ substr($race->date, 0, 10) }} </small> </h4>
						<h6 class="card-subtitle mb-2 text-muted">Väderinfo: {{ $race->weather}} {{ strlen($race->temp) > 0 ? $race->temp. ' grader' : '' }}<span></span> </h6>
						<p class="card-text"></p>
						<?php $edittrackurl = url('/data/edit/trackdata/'.$race->id); ?>
						<a class="card-link" href="{{ $edittrackurl }}">Trackdata <span class="badge">{{ $trackdataids[$race->id] }}</span></a>
					</div>
				</div>
			</div>
		@endforeach


	</div>
</div>
@endsection
