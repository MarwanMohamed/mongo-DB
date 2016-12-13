@extends('layout')
@section('content')
	<div class="container">
		<h1>Docments</h1><br>

		@if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
		<a href="{{ Url('documentation/'.$name.'/create') }}" class="btn btn-info">Add New Document</a>
		<hr>

		{{App\MongoDb::recursive($paginate,true, $name)}}
		<nav aria-label="...">
			<ul class="pagination">

		@if ($pagination->totalPages() > 1) 

			@if ($pagination->hasNext()) 
				<li><a href=?page={{$pagination->nextPage()}}>&raquo;</a></li>
			@endif

			@for($i = max(1, $currentPage - 2); $i <= min( $currentPage + 2, $pagination->totalPages()); $i++)
				@if ($i == $currentPage)
					<li class="active"><a href=?page={{$i}}> {{$i}} </a></li>
				@else
						<li><a href=?page={{$i}}> {{$i}} </a></li>
				@endif
			@endfor

			@if ($pagination->hasPrev()) 
				<li><a href=?page={{$pagination->prevPage()}}>&laquo;</a></li>
			@endif
		@endif
		  	</ul>
		</nav>
			
	</div>
@stop