@extends('layouts.standard')

@section('title', 'Test range')

@section('content')
<div class="container">
	<h1>TEST RANGE</h1>
	<?php print_r($inputs['speed']); ?>
</div>
@endsection
