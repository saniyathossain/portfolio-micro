<!doctype html>
<html lang="en">

	@includeIf($BaseLibrary->moduleFrontendViewPartialHead)

	@hasSection('content')
		@yield('content')
	@endif

	{{-- @includeIf($BaseLibrary->moduleFrontendViewPartialFooter) --}}

</html>
