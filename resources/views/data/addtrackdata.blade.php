@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
	<h1>ADD TRACKDATA</h1>
	<table width="600px">
		<form action="{{ route('addtrackdataconfirm') }}" method="post" enctype="multipart/form-data">
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
	@if(count($trackinputs) > 0)
		<h2>Vill du lägga till följande data?</h2>
		<form action="{{ route('addtrackdataprocess') }}" method="post">
			<input class='btn btn-primary btn-small' type="submit" name="addtrackdatabtn" value="Lägg till trackdata">
			<br>
			<br>
			@csrf
			<table class='table'>
			@foreach($trackinputs as $row)
				<tr>
					@foreach($row as $key => $value)
						<td>{{htmlspecialchars($value)}}</td>
						<input type="hidden" name="{{$key}}[]" value="{{$value}}">
					@endforeach
				</tr>
			@endforeach
			</table>
		</form>
	@endif


@endsection
