<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	 <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />
    <meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="{!! url($BaseLibrary->assetsFaviconPath.'ms-icon-144x144.png') !!}">
	<meta name="theme-color" content="#ffffff">
	<title>{!! $title ?? '' !!}</title>

	<link rel="apple-touch-icon" sizes="57x57" href="{!! url($BaseLibrary->assetsFaviconPath.'apple-icon-57x57.png') !!}">
	<link rel="apple-touch-icon" sizes="60x60" href="{!! url($BaseLibrary->assetsFaviconPath.'apple-icon-60x60.png') !!}">
	<link rel="apple-touch-icon" sizes="72x72" href="{!! url($BaseLibrary->assetsFaviconPath.'apple-icon-72x72.png') !!}">
	<link rel="apple-touch-icon" sizes="76x76" href="{!! url($BaseLibrary->assetsFaviconPath.'apple-icon-76x76.png') !!}">
	<link rel="apple-touch-icon" sizes="114x114" href="{!! url($BaseLibrary->assetsFaviconPath.'apple-icon-114x114.png') !!}">
	<link rel="apple-touch-icon" sizes="120x120" href="{!! url($BaseLibrary->assetsFaviconPath.'apple-icon-120x120.png') !!}">
	<link rel="apple-touch-icon" sizes="144x144" href="{!! url($BaseLibrary->assetsFaviconPath.'apple-icon-144x144.png') !!}">
	<link rel="apple-touch-icon" sizes="152x152" href="{!! url($BaseLibrary->assetsFaviconPath.'apple-icon-152x152.png') !!}">
	<link rel="apple-touch-icon" sizes="180x180" href="{!! url($BaseLibrary->assetsFaviconPath.'apple-icon-180x180.png') !!}">
	<link rel="icon" type="image/png" sizes="192x192" href="{!! url($BaseLibrary->assetsFaviconPath.'android-icon-192x192.png') !!}">
	<link rel="icon" type="image/png" sizes="32x32" href="{!! url($BaseLibrary->assetsFaviconPath.'favicon-32x32.png') !!}">
	<link rel="icon" type="image/png" sizes="96x96" href="{!! url($BaseLibrary->assetsFaviconPath.'favicon-96x96.png') !!}">
	<link rel="icon" type="image/png" sizes="16x16" href="{!! url($BaseLibrary->assetsFaviconPath.'favicon-16x16.png') !!}">
    <link rel="manifest" href="{!! url($BaseLibrary->assetsFaviconPath.'manifest.json') !!}">

	@includeIf($BaseLibrary->moduleFrontendViewPartialStylesheets)

	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script defer src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
