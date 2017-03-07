@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

					<h1>Welcome, {{ Auth::user()->name }}</h1>

					<br /><br />

					<div class="row">

						<div class="col-md-8">

							<div class="panel panel-default">

								<div class="panel-heading">

									<h3>Task to do today</h3>

									@if( sizeof(Auth::user()->posts()) )
										<a href="/posts">View All</a>
									@endif

								</div>

								@if( $schedules )

									@foreach( $schedules as $schedule )

										<?php $posts = $schedule->getPosts(); ?>

										@if( sizeof($posts) )

											<ul class="list-group">

												<li class="list-group-item">

													<small class="text-muted">{{ $schedule->quantity }} {{ $schedule->duration }} ago</small>
													-
													<small class="text-muted">{{ date("d-m-Y, D", strtotime( '-' . $schedule->quantity . ' ' . $schedule->duration ))}}</small>

													<div class="row">

														<div class="col-sm-8 col-sm-offset-2">

															@foreach($posts as $post)

																<h3><a href="/posts/{{ $post->id }}">{{$post->title}}</a></h3>

																<?php $categories = $post->getCategories(); ?>

																<small>
																	@foreach($categories as $category)
																		{{ App\Category::where('slug',$category)->first()->title }}
																	@endforeach
																</small>

															@endforeach

														</div>

													</div>


												</li>

											</ul>

										@endif

									@endforeach

								@else
									You don't have a schedule set, set it from <a href="/settings">here</a>
								@endif


							</div><!-- /.panel -->

						</div><!-- /.col-md-8 -->

						<div class="col-md-4">

							<a href="/posts/add" class="btn btn-primary btn-block btn-lg">
								Add a Post
							</a>

						</div><!-- /.col-md-4 -->

					</div><!-- /.row -->

        </div>
    </div>
</div>
@endsection
