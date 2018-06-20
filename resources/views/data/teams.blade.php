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
<?php
$deleteteamurl = url('/data/teams/delete/'.$row->id);
?>
<tr>
	<td>
		<div id='name_{{$row->id}}' onclick="toForm('name_{{$row->id}}', {{$row->id}}, '{{$row->name}}', 'name')">{{isset($row->name) ? $row->name : '-'}}</div>
	</td>
	<td>
		<div id='carbrand_{{$row->id}}' onclick="toForm('carbrand_{{$row->id}}', {{$row->id}}, '{{$row->carbrand}}', 'carbrand')">{{isset($row->carbrand) ? $row->carbrand : '-'}}</div>
	</td>
	<td>
		<div id='no_{{$row->id}}' onclick="toForm('no_{{$row->id}}', {{$row->id}}, '{{$row->no}}', 'no')">{{isset($row->no) ? $row->no : '-'}}</div>
	</td>
	<td>
		<div id='class_{{$row->id}}' onclick="toForm('class_{{$row->id}}', {{$row->id}}, '{{$row->class}}', 'class')">{{isset($row->class) ? $row->class : '-'}}</div>
	</td>
	<td>
		<a href="{{$deleteteamurl}}" onclick="return confirm('Vill du ta bort {{$row->name}}?');">delete</a>&nbsp;&nbsp;
	</td>
@endforeach
<tr style='height: 40px'>
	<td colspan='4'><div id='addteam' onclick="toFormAdd()">+ Lägg till team</div></td>
</tr>
	</tbody>
</table>

@endsection
