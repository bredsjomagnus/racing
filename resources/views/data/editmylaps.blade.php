@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
	<h3 class='bluerow'>MYLAPS</h3>
	<div id='mylapstable'>
		<input type="text" v-model="search" class="form-control" placeholder="Filter for name, speed, transponder and class..."/>
		<br>
	    <table class="table table-striped monoline">
	      <thead>
	        <tr class='lightbluerow'>
	          <th v-for="column in columns">
	            <a class='headerdatarow' href="#"
	               @click="sortBy(column)">
	              @{{ column | capitalize }}
	            </a>
	          </th>
	        </tr>
	      </thead>

	      <tbody>
	        <tr v-for="row in filteredTracks">
	          <td>@{{ row.no }}</td>
	          <td v-if='row.teamid != -1'><a :href="teamurl(row.teamid)">@{{ row.name }}</a></td>
	          <td v-if='row.teamid == -1'>@{{ row.name }}</td>
	          <td>@{{ row.laps }}</td>
			  <td>@{{ row.lead }}</td>
	          <td>@{{ row.lap_time }}</td>
	          <td>@{{ row.speed }}</td>
	          <td>@{{ row.elapsed_time }}</td>
	          <td>@{{ row.passing_time }}</td>
	          <td>@{{ row.hits }}</td>
	          <td>@{{ row.strength }}</td>
	          <td>@{{ row.noice }}</td>
	          <td>@{{ row.transponder }}</td>
	          <td>@{{ row.class }}</td>
	          <td>@{{ row.deleted }}</td>
	        </tr>
	      </tbody>
	    </table>
	</div>


@endsection
