@extends('layouts.standard')

@section('title', 'Test range')

@section('content')

<div class="container">




	<div id='tablevue'>
		<br>
		<br>
		<br>
		<input type="text" v-model="search" class="form-control" placeholder="Filter..."/>

	    <table class="table table-striped">

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
	          <td>@{{ row.name }}</td>
	          <td>@{{ row.speed }}</td>
	        </tr>
	      </tbody>
	    </table>
	</div>


	<!-- <div id='test-root' style="padding-top: 50px">
		<table class='table'>
			<thead>
				<th>Namn</th>
				<th>Speed</th>
				<th>Elapsed Time</th>
				<th>Passing Time</th>
				<th>Hits</th>
				<th>Strength</th>
			</thead>
			<tbody>
				<tr v-for='row in res'>
					<td>@{{ row.name }}</td>
					<td>@{{ row.speed }}</td>
				</tr>
			</tbody>
		</table>
	</div> -->

</div>
@endsection
