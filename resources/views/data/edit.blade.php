@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
	<h1>TRACKDATA</h1>
	<table class='table'>
		<thead>
			<th>DB #ID</th>
			<th>Namn</th>
			<th>Lap time</th>
			<th>Speed</th>
			<th>Elapsed Time</th>
			<th>Passing Time</th>
			<th>Hits</th>
			<th>Strength</th>
			<th>Noice</th>
			<th>Photocell time</th>
			<th>Transponder</th>
			<th>Backup TX</th>
			<th>Backup Passing Time</th>
		</thead>
		<tbody>

			@foreach($res as $row)
			<tr>
				<td>{{$row->id}}</td>
				<td>{{$row->name}}</td>
				<td>{{$row->lap_time}}</td>
				<td>{{$row->speed}}</td>
				<td>{{$row->elapsed_time}}</td>
				<td>{{$row->passing_time}}</td>
				<td>{{$row->hits}}</td>
				<td>{{$row->strength}}</td>
				<td>{{$row->noice}}</td>
				<td>{{$row->photocell_time}}</td>
				<td>{{$row->transponder}}</td>
				<td>{{$row->backup_tx}}</td>
				<td>{{$row->backup_passing_time}}</td>
			</tr>

			@endforeach
		</tbody>

	</table>

@endsection
