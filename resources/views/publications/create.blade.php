@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Publication create</div>

	                <div class="card-body">
						<form action="{{ route('publication.store') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group row">
								<label for="title" class="col-md-3 col-form-label text-md-right">Title</label>

								<div class="col-md-7">
									<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

									@error('title')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="description" class="col-md-3 col-form-label text-md-right">Description</label>

								<div class="col-md-7">
									<textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required autocomplete="description" autofocus>{{ old('description') }}</textarea>
									@error('description')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="img" class="col-md-3 col-form-label text-md-right">Image</label>

								<div class="col-md-7">
									<input type="file" name="image" id="img" class="p-1 form-control @error('image') is-invalid @enderror" required autocomplete="image" autofocus>
									@error('image')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-8 offset-md-3">
									<button type="submit" class="btn btn-primary">
										Submit
									</button>
								</div>
							</div>
						</form>
	                </div>
				</div>
			</div>
		</div>
	</div>
@endsection
