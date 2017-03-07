@extends('layouts.app')

@section('content')

	<div class="row">

		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default">

				<div class="panel-heading">

					<h4>Edit comment</h4>

				</div><!-- /.panel-heading -->

				<div class="panel-body">

					<form action="/posts/{{ $post->id }}/editComment/{{ $comment->id }}" method="post" >

						{{ csrf_field() }}

						{{ method_field('PUT') }}

						<div class="form-group">

							<label for="title" class="form-label">Title:</label>

							<input name="title" id="title" class="form-control" value="{{ $comment['title'] }}" />

						</div><!-- /.form-group -->

						<div class="form-group">

							<label for="rating" class="form-label">Rating</label>

							<select name="rating" class="form-control">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>

						</div><!-- /.form-group -->

						<div class="form-group">

							<label for="description" class="form-label">Comment:</label>

							<textarea name="description" id="description" class="form-control" rows="5">{{ $comment['description'] }}</textarea>

						</div><!-- /.form-group -->

						<button type="submit" class="btn btn-primary">Update</button>

						<a href="/posts/{{ $post->id }}" class="btn btn-danger">Cancel</a>

					</form>

				</div><!-- /.panel-body -->

			</div><!-- /.panel -->

		</div><!-- /.col-md-8 -->

	</div><!-- /.row -->

@endsection
