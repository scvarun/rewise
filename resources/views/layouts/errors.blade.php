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
