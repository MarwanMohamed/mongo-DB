@extends('layout')
@section('content')


	<div class="container">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>Show</th>
				</tr>
			</thead>
			<tbody>
				@foreach($collections as $collection)
				<tr>
					<td>{{ $collection->getName() }}</td>
			  		<td><a href="{{Url('/documentation/'. $collection->getName())}}" class="btn btn-info btn-sm">Documentation</a></td>
				</tr>
				@endforeach	
		  	</tbody>
		</table>
	</div>



	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@stop