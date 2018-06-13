@extends('layouts.standard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<h3>DASHBOARD</h3>
		<p>Detta blir yta för databasinformation.</p>
    </div>
	<div class="row">
		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item">
					<span class="badge">{{$numberoftrackdata}}</span>
					<a href="#">Trackdata</a>
				</li>
			</ul>
		</div>

	</div>
</div>
@endsection
