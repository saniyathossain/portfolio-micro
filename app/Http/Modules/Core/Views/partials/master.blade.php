<!DOCTYPE html>
<html lang="en">

	@include($BaseLibrary->moduleCoreViewPartialHead)

	<body class="hold-transition skin-blue sidebar-mini">

		<div class="wrapper">

			@include($BaseLibrary->moduleCoreViewPartialHeader)

			@include('flash::message')

			@include($BaseLibrary->moduleCoreViewPartialSidebar)

			<div class="{{ Auth::check() ?  'content-wrapper' : '' }}">

				<div id="ajax-loader" class="hide">
					{!! $BaseLibrary->ajaxLoaderHTML !!}
				</div>

				@hasSection('content')
					@yield('content')
				@endif

			</div>

			@include($BaseLibrary->moduleCoreViewPartialFooter)

		</div>

	</body>

</html>
