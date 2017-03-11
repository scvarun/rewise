@extends('layouts.app')

@section('content')
	<div class="container">

		<div class="row">

			@include('layouts.errors')

			<div class="panel panel-default">

				<div class="panel-heading">

					<h2>Posts</h2>

				</div><!-- /.panel-heading -->

				<ul class="list-group">

					@foreach($posts as $post)

						<li class="list-group-item">

							<h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>

						</li>

					@endforeach

				</ul>

        {{ $posts->links() }}

			</div><!-- /.panel-->

		</div><!-- /.row -->

	</div><!-- /.container -->
@endsection
