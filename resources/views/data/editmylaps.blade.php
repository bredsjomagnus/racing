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
			  <th colspan='3'>
				  ACTIONS
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
	          <td>@{{ row.transponder }}</td>
	          <td>@{{ row.class }}</td>
	          <td>@{{ row.deleted }}</td>
	          <td>
				  <a :href="url(row.id, 'inspect')">
					  <span class='glyphicon glyphicon-search'></span>
				  </a>
			  </td>
	          <td>
				  <a :href="url(row.id, 'edit')">
					  <span class='glyphicon glyphicon-pencil'></span>
				  </a>
			  </td>
	          <td>
				  <a :href="url(row.id, 'delete')" onclick='return confirm("Vill du ta bort raden?")'>
					  <span class='glyphicon glyphicon-trash'></span>
				  </a>

			   </td>
	        </tr>
	      </tbody>
	    </table>
	</div>


@endsection
