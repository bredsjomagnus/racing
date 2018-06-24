@extends('layouts.frontsidelayout')

@section('content')

<center>
<h2>KLASS R1 - {{date('Y')}}</h2>
<table class='table table-striped'>
	<thead>
		<tr class='resulttableheader'>
			@foreach($header as $headerrow)
				<th>{{$headerrow}}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($r1table as $r1row)
			<tr>
			@foreach($r1row as $row)
				<td>{{$row}}</td>
			@endforeach
			</tr>
		@endforeach
	</tbody>
</table>

<h3>KLASS R2 - {{date('Y')}}</h3>
<table class='table table-striped'>
	<thead>
		<tr class='resulttableheader'>
			@foreach($header as $headerrow)
				<th>{{$headerrow}}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($r2table as $r2row)
			<tr>
			@foreach($r2row as $row)
				<td>{{$row}}</td>
			@endforeach
			</tr>
		@endforeach
	</tbody>
</table>

<h3>KLASS STANDARD - {{date('Y')}}</h3>
<table class='table table-striped'>
	<thead>
		<tr class='resulttableheader'>
			@foreach($header as $headerrow)
				<th>{{$headerrow}}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($standardtable as $standardrow)
			<tr>
			@foreach($standardrow as $row)
				<td>{{$row}}</td>
			@endforeach
			</tr>
		@endforeach
	</tbody>
</table>

</center>
@endsection
