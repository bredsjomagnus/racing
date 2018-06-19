@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
	<h3>Hard card data</h3>
	<div id='hardcardtable'>
		<br>
		<br>
		<br>
		<input type="text" v-model="search" class="form-control" placeholder="Filter for firstname, lastname, tagid and lap_time..."/>

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
	          <td>@{{ row.tagid }}</td>
	          <td>@{{ row.frequency }}</td>
	          <td>@{{ row.signalstrength }}</td>
			  <td>@{{ row.antenna }}</td>
	          <td>@{{ row.time }}</td>
	          <td>@{{ row.datetime }}</td>
	          <td>@{{ row.hits }}</td>
	          <td>@{{ row.competitorid }}</td>
	          <td>@{{ row.competitionnumber }}</td>
	          <td>@{{ row.firstname }}</td>
	          <td>@{{ row.lastname }}</td>
	          <td>@{{ row.lap_time }}</td>
	          <td>@{{ row.deleted }}</td>
	        </tr>
	      </tbody>
	    </table>
	</div>


@endsection
