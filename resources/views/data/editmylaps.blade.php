@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
	<h1>TRACKDATA</h1>
	<div id='mylapstable'>
		<br>
		<br>
		<br>
		<input type="text" v-model="search" class="form-control" placeholder="Filter for name, speed, transponder and class..."/>

	    <table class="table table-striped monoline">

	      <thead>
	        <tr>
	          <th v-for="column in columns">
	            <a href="#"
	               @click="sortBy(column)">
	              @{{ column | capitalize }}
	            </a>
	          </th>
	        </tr>
	      </thead>

	      <tbody>
	        <tr v-for="row in filteredTracks">
	          <td>@{{ row.no }}</td>
	          <td>@{{ row.name }}</td>
	          <td>@{{ row.laps }}</td>
			  <td>@{{ row.lead }}</td>
	          <td>@{{ row.lap_time }}</td>
	          <td>@{{ row.speed }}</td>
	          <td>@{{ row.elapsed_time }}</td>
	          <td>@{{ row.passing_time }}</td>
	          <td>@{{ row.hits }}</td>
	          <td>@{{ row.strength }}</td>
	          <td>@{{ row.noice }}</td>
	          <td>@{{ row.photocell_time }}</td>
	          <td>@{{ row.transponder }}</td>
	          <td>@{{ row.backup_tx }}</td>
	          <td>@{{ row.backup_passing_time }}</td>
	          <td>@{{ row.class }}</td>
	          <td>@{{ row.deleted }}</td>
	        </tr>
	      </tbody>
	    </table>
	</div>


@endsection
