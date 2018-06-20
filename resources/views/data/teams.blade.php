@extends('layouts.standard')

@section('title', 'Teams')

@section('content')
<h3>Teams</h3>
<table class='table table-striped'>
	<thead>
		<th>Team</th>
		<th>Bilmärke</th>
		<th>Nummer</th>
		<th>Class</th>
	</thead>
	<tbody>
@foreach($res as $row)
<tr>
	<td>{{ $row->name }}</td>
	<td>{{$row->carbrand}}</td>
	<td>{{$row->no}}</td>
	<td>{{$row->class}}</td>
</tr>
@endforeach
	</tbody>
</table>

@endsection
