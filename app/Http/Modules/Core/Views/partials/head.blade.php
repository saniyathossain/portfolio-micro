
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $BaseLibrary->companyName }} :: {{ $title ?? '' }}</title>

<link href="{!! asset($BaseLibrary->assetsImagePath.'favicon.ico') !!}" rel="shortcut icon" type="image/x-icon" />

@forelse ($BaseLibrary->cssFiles($public = $BaseLibrary->assetsPublicPath) as $key_css => $css)
	<link rel="stylesheet" href="{{ $css }}">
@empty
@endforelse

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/ie.css">
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.33/polyfill.min.js"></script>
<![endif]-->

<script>
	window.App				= window.App || {};
	App.appKey				= '{!! config('app.key') !!}';
	App.appEnv				= '{!! config('app.env') !!}';
	App.appDebug			= '{!! config('app.debug') !!}';
	App.siteURL				= '{!! url('/') !!}';
	App.currentURL			= '{!! request()->url() !!}';
	App.fullURL				= '{!! request()->fullUrl() !!}';
	App.apiURL				= '{!! url('api') !!}';
	App.assetURL			= '{!! url('assets') !!}';
	App.appPath				= 'app_path()';
	App.authCheck			= '{!! auth()->check() !!}';
	App.authEmployeeId		= '{!! auth()->check() ? auth()->user()->employee_id : null !!}';
	App.messageCommonError	= '{!! $BaseLibrary->messageCommonError !!}';
	App.loggedEmployee		= '{!! session('logged_employee') !!}';
</script>

@forelse ($BaseLibrary->jsFiles($public = $BaseLibrary->assetsPublicPath) as $key_js => $js)
	{{-- @php
		$defer_except	= ['local-js-jquery-v2.2.4'];
		$defer			= !in_array($key_js, $defer_except) ? 'defer' : '';
	@endphp --}}

	<script src="{{ $js }}"></script>
@empty
@endforelse

@stack('scripts')
