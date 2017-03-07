@extends('layouts.app')

@section('content')

	<div class="container">

		<div class="row">

			<div class="col-md-8 col-md-offset-2">

				@include('layouts.errors')

				<div class="panel panel-default">

					<div class="panel-heading">

						<h2>{{ $post->title }}</h2>

						<a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a>
						<form action="/remove/post/{{$post->id}}" method="post">
							{{ method_field("DELETE") }}
							{{ csrf_field() }}
							<button type="submit" class="btn btn-danger">Delete</button>
						</form>

					</div><!-- /.panel-header -->

					<div class="panel-body">

						@markdown($post->description)

					</div><!-- /.panel-body -->

				</div><!-- /.panel -->

				<div class="panel panel-default">


						@if( sizeof($post->comments()->get() ) )

							<div class="panel-heading">
								<h4> {{ sizeof($post->comments()->get() ) }} Comments</h4>

								@if( $post->canWriteCommentToday() )
									<a href="/posts/{{$post->id}}/addComment">Add Comment</a>
								@endif
							</div><!-- /.panel-heading -->


							<ul class="list-group">
								@foreach( $post->comments()->get() as $comment )
								<li class="list-group-item">
									<small class="rating" style="width:{{ $comment->rating*20 }}"></small>
									<h4>{{ $comment->title }}</h4>
									<small class="text-muted" title="{{ $comment->created_at->format('Y-m-d')}}">{{ $comment->created_at->diffForHumans() }}</small>
									<br />
									<a href="/posts/{{ $post->id }}/editComment/{{ $comment->id }}"><small>Edit</small></a>
									<a href="/posts/{{ $post->id }}/deleteComment/{{ $comment->id }}" class="text-danger"><small>Delete</small></a>
									<hr />
									<p>
										{{ $comment->description }}
									</p>
								</li>
								@endforeach
							</ul><!-- /.panel-body -->
						@else
							<div class="panel-heading">
								<h4>No Comments</h4>

								@if( $post->canWriteCommentToday() )
									<a href="/posts/{{$post->id}}/addComment">Add Comment</a>
								@endif
							</div><!-- /.panel-heading -->
						@endif

				</div><!-- /.panel-default -->

			</div><!-- /.col-md-8 -->

		</div><!-- /.row -->

	</div><!-- /.container -->

@endsection
