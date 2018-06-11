@extends('layouts.standard')

@section('title', 'Groups')

@section('content')
	<h1>ADD TRACKDATA</h1>
	<table width="600px">
		<form action="{{ route('addtrackdataprocess') }}" method="post" enctype="multipart/form-data">
			@csrf
			<tr>
				<td width="20%">Select file</td>
				<td width="80%"><input type="file" name="file" id="file" onchange="validateFile()" /></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="submit" value='Importera' id='importera' /></td>
			</tr>
		</form>
	</table>
	<br>
	@if(count($trackdata) > 0)
		<h2>Vill du lägga till följande data?</h2>
		<table class='table'>
		@foreach($trackdata as $row)
			<?php $rowdata = explode(";", $row); ?>
			<tr>
				@foreach($rowdata as $celldata)
					<td>{{htmlspecialchars($celldata)}}</td>
				@endforeach
			</tr>
		@endforeach
		</table>
	@endif


@endsection
