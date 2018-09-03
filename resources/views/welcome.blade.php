<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">

	<style>
		.block{
			box-shadow: 4px 3px 5px 3px silver;
			margin-top: 20px;
		}
		.alert{
			position: relative;
			padding: .75rem 1.25rem;
			margin-bottom: 1rem;
			border: 1px solid transparent;
			border-radius: .25rem;
			margin-top: 10px;
		}

		.alert-danger{
			color: #721c24;
			background-color: #f8d7da;
			border-color: #f5c6cb;
		}

		.alert-success{
			color: #155724;
			background-color: #d4edda;
			border-color: #c3e6cb;
		}
	</style>
</head>
<body>
	<section id="content">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col s12">
						@if(session('success'))
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						@endif
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
					</div>

					@for ($i = 0; $i < $qty; $i++)
						<form name="form-{{$i}}" method="post" action="/" enctype="multipart/form-data">
							{{ csrf_field() }}

							<input type="hidden" name="id" value="{{$i}}">

							<div class="block">
								<div class="row">
									<div class="col m6">
										<p>
											<input name="photo-{{$i}}" type="file" class="validate" required>
										</p>

										@isset(${'photo'.$i})
											<p>
												<img class="materialboxed responsive-img" src="{{(${'photo'.$i})}}">
											</p>
										@endisset
									</div>

									<div class="col m3">
										<p>
											<label>
												<input name="filter-grey-{{$i}}" type="checkbox"/>
												<span>Greyscale</span>
											</label>
										</p>
										<p class="range-field">
											Contrast:
											<input name="filter-contrast-{{$i}}" type="range" id="filter-contrast" value="0" min="-100" max="100"/>
										</p>
										<p class="range-field">
											Pixelate:
											<input name="filter-pixelate-{{$i}}" type="range" id="filter-pixelate" value="0" min="0" max="10"/>
										</p>
										<p class="range-field">
											Blur: <input name="filter-blur-{{$i}}" type="range" id="filter-blur" value="1" min="0" max="30"/>
										</p>
									</div>

									<div class="col m3">
										<div class="row">
											<div class="input-field col s12">
												<input name="filter-width-{{$i}}" id="filter-width" type="text" class="validate">
												<label for="filter-width">Width:</label>
											</div>
										</div>
										<div class="row">
											<div class="input-field col s12">
												<input name="filter-height-{{$i}}" id="filter-height" type="text" class="validate">
												<label for="filter-height">Height:</label>
											</div>
										</div>
										<div class="row">
											<div class="input-field col s12">
												<button class="btn waves-effect waves-light" type="submit" name="action">Apply
													<i class="material-icons right">send</i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					@endfor
				</div>
			</div>
		</div>
	</section>

	<!-- Compiled and minified JavaScript -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
	<script>
		jQuery(function($){


			$('.materialboxed').materialbox();
		});
	</script>
</body>
</html>
