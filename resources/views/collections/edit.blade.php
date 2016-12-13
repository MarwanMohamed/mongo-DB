@extends('layout')
@section('content')
<div class="container">
	<h1>Add</h1>
	<hr>

	<div class="form-group">
		<label>Edit Json Object:</label>
		<form action="" method="post">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="row">
				<div class="col-md-8">
					<textarea name="document" class="form-control" style="margin-bottom: 10px;height: 200px">
						{{$document}}
					</textarea>
				</div>
			</div>
			<button class="btn btn-primary">Save</button>
		</form>

		@if(count($errors) > 0)
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">{{$error}}</div>
			@endforeach
		@endif
	</div>
</div>

@stop