<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token">
        <title>@yield('title')</title>

		<!-- axios, loadash, vue -->
		<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/lodash@4.13.1/lodash.min.js"></script>

		<script src="https://d3js.org/d3.v5.min.js"></script>

		<!-- not working asset -->
		<!-- <script type="text/javascript" src="{{ asset('js/vue.js') }}"></script> -->

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

		<!-- fontawesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">



		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" type="text/css"> -->

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-theme.min.css') }}" type="text/css"> -->

		<!-- Own sheet -->

		<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" type="text/css">
		<!-- <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" type="text/css"> -->

    </head>
	<body>
		{{-- This is the main navbar --}}
        @include('includes.inloggednavbar')

		@include('includes.links')

		<div id='page'>
			<div class="col-md-1">
			</div>

	        <div class='col-md-10'>
	            @yield('content')
	        </div>

			<div class="col-md-1">
				@yield('rightsidepanel')
			</div>
		</div>

		<!-- FusionChart -->
		<!-- <script type="text/javascript" src="{{ asset('js/fusioncharts.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/fusioncharts.charts.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/themes/fusioncharts.theme.fint.js') }}"></script> -->

		<!-- JQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- <script src="{{ URL::asset('js/bootstrap.min.js') }}" type='text/javascript'></script> -->
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<?php
		$urlsegemnts = Request::segments(); // get path segmetns in array eg. [groups, 'edit', '<parameter>']
		?>

		<script src="{{ URL::asset('js/vue-app.js') }}" type='text/javascript'></script>
		<script src="{{ URL::asset('js/app.js') }}" type='text/javascript'></script>
		<script src="{{ URL::asset('js/d3asset.js') }}" type='text/javascript'></script>

		@if(Request::path() == "data/addmylapsdata" || Request::path() == "data/addhardcarddata")
		<!-- Script handeling import group via .csv feature -->
			<script src="{{ URL::asset('js/importtrackdata.js') }}" type='text/javascript'></script>
		@endif

		<script src="{{ URL::asset('js/editteam.js') }}" type='text/javascript'></script>

	</body>
</html>
