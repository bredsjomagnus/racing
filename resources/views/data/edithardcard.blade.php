@extends('layouts.standard')

@section('title', 'Trackdata')

@section('content')
	<h3 class='bluerow'>Hard card data</h3>
	<div id='hardcardtable'>
		<input type="text" v-model="search" class="form-control" placeholder="Filter for firstname, lastname, tagid and lap_time..."/>
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
			  <th colspan=3>ACTIONS</th>
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
