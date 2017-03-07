@extends('layouts.app')

@section('scripts')
	<script src="/js/bootstrap-datepicker.min.js"></script>
	<script src="/js/simplemde.min.js"></script>
	<script src="/js/selectize.min.js"></script>
@endsection

@section('styles')
	<link rel="stylesheet" href="/css/bootstrap-datepicker.min.css" />
	<link rel="stylesheet" href="/css/simplemde.min.css" />
	<link rel="stylesheet" href="/css/selectize.css" />
	<link rel="stylesheet" href="/css/selectize.default.css" />
	<link rel="stylesheet" href="/css/selectize.bootstrap3.css" />
@endsection

@section('content')

	<div class="container">

		<div class="row">

			<div class="col-md-8 col-md-offset-2">

				@if( Session::has('alert-success'))

					<div class="alert alert-success alert-dismissible" role="alert">

					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						<p>
							{{ Session::get('alert-success') }}
						</p>

					</div>

				@endif


				@if (count($errors) > 0)
			    <div class="alert alert-danger">
		        <ul>
	            @foreach ($errors->all() as $error)
              	<li>{{ $error }}</li>
	            @endforeach
		        </ul>
			    </div>
				@endif


				<div class="panel panel-default">

					<div class="panel-heading">

						<h3>Add Post</h3>

						<a href="/posts" class="text-danger">Back to Posts</a>

					</div><!-- /.panel-heading -->

					<div class="panel-body">

						<form action="/posts/{{ $post->id }}/edit/" method="POST">

							{{ method_field('PUT') }}

							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

								<label class="form-label" for="title">Title:</label>

								<input type="text" name="title" id="title" class="form-control"  value="{{ $post->title }}" required autofocus/>

								@if ($errors->has('title'))
									<span class="help-block">
										<strong>{{ $errors->first('title') }}</strong>
									</span>
								@endif

							</div>

							<div class="row">

								<div class="col-md-6">

									<div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">

										<label class="form-label" for="category">Category:</label>

										@php
											$cats = $post->getCategories();
										@endphp

										<select name="category[]" class="selectpicker" multiple>
											@foreach($categories as $category)
												@if( in_array($category->slug, $cats) )
												<option selected="selected">{{ $category->title }}</option>
												@else
												<option>{{ $category->title }}</option>
												@endif
											@endforeach
										</select>

										@if ($errors->has('category'))
											<span class="help-block">
												<strong>{{ $errors->first('category') }}</strong>
											</span>
										@endif

									</div>

								</div><!-- /.col-md-6 -->

								<div class="col-md-6">

									<div class="form-group{{ $errors->has('publish_date') ? ' has-error' : '' }}">

										<label class="form-label" for="publish-date">Publish Date</label>

										<input type="text" name="publish_date" id="publish_date" disabled class="form-control datepicker" value="{{ date('m/d/Y', strtotime($post->publish_date)) }}" required />

									</div><!-- /.form-group -->

								</div><!-- /.col-md-6 -->

							</div><!-- /.row -->

							<div class="form-group">

								<label class="form-label" for="description">Description:</label>

								<textarea id="description" name="description" class="form-control markdown-editor" rows=10>{{ $post->description }}</textarea>

							</div>

							<button type="submit" class="btn btn-primary pull-right">Submit</button>

							<a href="/posts" class="text-danger">Cancel</a>

						</form>

					</div><!-- /.panel-body -->

				</div><!-- /.panel -->

			</div><!-- /.col-md-8 -->

		</div><!-- /.row -->

	</div><!-- /.container -->

@endsection
