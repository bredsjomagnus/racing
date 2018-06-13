@extends('layouts.standard')

@section('title', 'Test range')

@section('content')
<div class="container">
	<h1>PHPINFO</h1>
	<?php phpinfo(); ?>
</div>
@endsection
