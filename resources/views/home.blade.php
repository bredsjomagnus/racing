@extends('layouts.standard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
			<div class="card" style="width: 18rem;">
				<div class="card-body">
					<h5 class="card-title">Card title</h5>
					<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					<a href="#" class="card-link">Card link</a>
					<a href="#" class="card-link">Another link</a>
				</div>
			</div>
        </div>
		<div class="col-md-3">
			<div class="card" style="width: 18rem;">
				<div class="card-header">
					Featured
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Cras justo odio</li>
					<li class="list-group-item">Dapibus ac facilisis in</li>
					<li class="list-group-item">Vestibulum at eros</li>
				</ul>
			</div>
		</div>
    </div>
</div>
@endsection
