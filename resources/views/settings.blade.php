@extends('layouts.app')

@section('content')
	<div class="container">

		<div class="row">

			<div class="col-md-8 col-md-offset-2">

				<div class="panel panel-default">

					<div class="panel-heading">

						<h1>Settings</h1>

					</div><!-- /.panel-heading -->

					<div class="panel-body">

						@if (count($errors) > 0)
					    <div class="alert alert-danger">
				        <ul>
			            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
			            @endforeach
				        </ul>
					    </div>
						@endif

						@if( Session::has('alert-success'))
							<div class="alert alert-success alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<p>
									{{ Session::get('alert-success') }}
								</p>
							</div>
						@endif

						<form method="post">

							{{ csrf_field() }}

							<div class="form-group col-md-6">

								<label class="form-label">Number</label>

								<input type="number" class="form-control" name="quantity" min="1" max="30" value="{{ old('quantity') ? old('quantity') : 1 }}" />

							</div><!-- /.form-group -->

							<div class="form-group col-md-6">

								<label class="form-label">Duration</label>

								<select name="duration" class="form-control">
									<option>Days</option>
									<option>Weeks</option>
									<option>Month</option>
								</select>

							</div>

							<div class="form-group col-md-12">

								<button type="submit" class="btn btn-primary">Add Date</button

							</div><!-- /.form-group -->

						</form>

						<hr  />

						<div class="col-md-12">

							@if(sizeof($schedule))

								<h3>Registered Schedules</h3>
								<br />

								<ul class="list-group">

								@foreach($schedule as $sche)

									<li class="list-group-item">
										<form action="/remove/schedule/{{$sche->id}}" method="post">
											<input type="hidden" name="_method" value="DELETE">
											{{ csrf_field() }}
											<button type="submit" class="btn btn-danger btn-xs pull-right">Delete</button>
										</form>
										{{ $sche->quantity }} {{ $sche->duration }}
									</li>

								@endforeach

								</ul>

							@endif

						</div>

					</div><!-- /.panel-body -->

				</div><!-- /.panel -->

			</div><!-- /.col-md-8 -->

		</div><!-- /.row -->

	</div><!-- /.container -->
@endsection
