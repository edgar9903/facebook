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
								<img src="{{ asset('/image/'.$publication->image) }}" class="w-100 publication-image">
							</div>
						</div>
						<div class="card-footer" publication="{{ \Crypt::encrypt($publication->id) }}">
							<div class="row">
								<i class="fa {{ $publication->getMyLike?'fa-thumbs-up text-primary':'fa-thumbs-o-up' }} fa-2x mx-3 like">{{ $publication->getLikes->count() }}</i>
								<i class="fa {{ $publication->getMyDislike?'fa-thumbs-down text-danger':'fa-thumbs-o-down' }} fa-2x dislike">{{ $publication->getDislikes->count() }}</i>
							</div>
							<div class="row my-3 all-comments">
								@foreach( $publication->getComments as $comment)
									<div class="col-md-12 px-4 my-1 position-relative">
										<span class="time">{{ \Carbon\Carbon::parse($comment->created_at)->format('H:i') }}</span>
										<div class="rounded bg-white p-2">
											<span class="text-primary font-weight-bold mr-2">{{ $comment->getUser->name }}</span> {{ $comment->comment }}
										</div>
									</div>
								@endforeach
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="input-group mb-3">
										<input type="text" class="form-control comment" placeholder="Write a comment ...">
										<div class="input-group-append send-comment">
											<span class="input-group-text"><i class="fa fa-chevron-right"></i></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
