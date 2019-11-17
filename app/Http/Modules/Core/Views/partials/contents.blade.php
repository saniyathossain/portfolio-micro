@auth
	@extends($BaseLibrary->moduleCoreViewPartialMaster)

	@section('content')

		@include($BaseLibrary->moduleCoreViewPartialBreadcrumb)

		<section class="content-header">
			<h1 class="mrg0A pad0A pull-left">
				{{ $title ?? '' }}
			</h1>

			@isset($crudControllerName)
				{{ $BaseLibrary->backButton(action($crudControllerName.'@index')) }}
			@endisset
			<div class="clearfix"></div>
		</section>

		<section class="content">
			<div class="box box-primary">
				<div class="box-body">
					@yield('contents')
				</div>
			</div>
		</section>

	@endsection
@endauth