@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
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
							<img src="{{ asset('/image/'.$publication->image) }}" class="w-100">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
