@auth
	@extends($BaseLibrary->moduleCoreViewPartialMaster)

	@section('content')

		@include($BaseLibrary->moduleCoreViewPartialBreadcrumb)

		<section class="content-header">
			<h1 class="mrg0A pad0A pull-left">
				{{ $title ?? '' }}
			</h1>
		</section>

		<div class="clearfix"></div>

		<section class="content">
			<div class="box box-primary">
				<div class="box-body">

				</div>
			</div>
		</section>
	@endsection
@endauth