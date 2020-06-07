@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				@if($publications->count())
					@foreach($publications as $publication)
						<div class="card mb-2">
							<div class="card-header">
								<span>{{ $publication->title }}</span>
								<form action="{{ route('publication.destroy',$publication->id) }}" method="POST" class="float-right">
									@csrf
									@method('DELETE')
									<button class="btn btn-danger">Delete</button>
								</form>
								<a href="{{ route('publication.edit',$publication->id) }}" class="float-right btn btn-warning mr-2">Edit</a>
							</div>
							<div class="card-body">
								<h5>{{ $publication->description }}</h5>
								<div class=" ">
									<img src="{{ asset('/image/'.$publication->image) }}" class="w-100 publication-image">
								</div>
							</div>
						</div>
					@endforeach
				@else
					<div class="card mb-2">
						<div class="card-header">
							You have no publications
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection
