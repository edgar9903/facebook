@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				@foreach($publications as $publication)
					<div class="card mb-2">
						<div class="card-header text-center">
							<span>{{ $publication->title }}</span>
						</div>
						<div class="card-body">
							<h5>{{ $publication->description }}</h5>
							<div class=" ">
								<img src="{{ asset('/image/'.$publication->image) }}" class="w-100">
							</div>
						</div>
						<div class="card-footer">
							<div class="row">

							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
