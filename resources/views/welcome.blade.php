@extends('layouts.frontsidelayout')

@section('content')

@if(count($r1table) > 0)
	<center>
	<h2>KLASS R1 - {{date('Y')}}</h2>
	<table class='table table-striped' style='width: {{$width}}'>
		<thead>
			<tr class='resulttableheader'>
				<?php $counter = 1; ?>
				@foreach($header as $headerrow)
					@if($counter < 5)
						<th>{{$headerrow}}</th>
					@else
						<th><center>{{$headerrow}}</center></th>
					@endif
					<?php $counter++; ?>
				@endforeach
			</tr>
			<tr class='resulttablesubheader'>
				@foreach($subheader as $subheaderrow)
					<td height="10" style='padding: 0'><center>{{$subheaderrow}}</center></td>
				@endforeach
			</tr>
		</thead>
		<tbody>
			<?php
			$pos = 1;
			?>
			@foreach($r1table as $r1row)
			<?php $counter = 1; ?>
				<tr>
					<td>{{$pos}}</td>
				@foreach($r1row as $row)
					@if($counter < 4)
						<td>{{$row}}</td>
					@else
						<td><center>{{$row}}</center></td>
					@endif
					<?php $counter++; ?>
				@endforeach
				</tr>
				<?php $pos++; ?>
			@endforeach
		</tbody>
	</table>

	<h2>KLASS R2 - {{date('Y')}}</h2>
	<table class='table table-striped' style='width: {{$width}}'>
		<thead>
			<tr class='resulttableheader'>
				<?php $counter = 1; ?>
				@foreach($header as $headerrow)
					@if($counter < 5)
						<th>{{$headerrow}}</th>
					@else
						<th><center>{{$headerrow}}</center></th>
					@endif
					<?php $counter++; ?>
				@endforeach
			</tr>
			<tr class='resulttablesubheader'>
				@foreach($subheader as $subheaderrow)
					<td height="10" style='padding: 0'><center>{{$subheaderrow}}</center></td>
				@endforeach
			</tr>
		</thead>
		<tbody>
			<?php $pos = 1; ?>
			@foreach($r2table as $r2row)
				<?php $counter = 1; ?>
				<tr>
					<td>{{$pos}}</td>
				@foreach($r2row as $row)
					@if($counter < 4)
						<td>{{$row}}</td>
					@else
						<td><center>{{$row}}</center></td>
					@endif
					<?php $counter++; ?>
				@endforeach
				</tr>
				<?php $pos++; ?>
			@endforeach
		</tbody>
	</table>

	<h2>KLASS STANDARD - {{date('Y')}}</h2>
	<table class='table table-striped' style='width: {{$width}}'>
		<thead>
			<tr class='resulttableheader'>
				<?php $counter = 1; ?>
				@foreach($header as $headerrow)
					@if($counter < 5)
						<th>{{$headerrow}}</th>
					@else
						<th><center>{{$headerrow}}</center></th>
					@endif
					<?php $counter++; ?>
				@endforeach
			</tr>
			<tr class='resulttablesubheader'>
				@foreach($subheader as $subheaderrow)
					<td height="10" style='padding: 0'><center>{{$subheaderrow}}</center></td>
				@endforeach
			</tr>
		</thead>
		<tbody>
			<?php $pos = 1; ?>
			@foreach($standardtable as $standardrow)
				<?php $counter = 1; ?>
				<tr>
					<td>{{$pos}}</td>
				@foreach($standardrow as $row)
					@if($counter < 4)
						<td>{{$row}}</td>
					@else
						<td><center>{{$row}}</center></td>
					@endif
					<?php $counter++; ?>
				@endforeach
				</tr>
				<?php $pos++; ?>
			@endforeach
		</tbody>
	</table>

	</center>
@else
<center>
	<h2>Här visas resultattabellerna för inlagda race.</h2>
</center>

@endif
@endsection
