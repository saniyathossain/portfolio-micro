
@forelse ($BaseLibrary->frontendCssFiles() as $css)
    <link rel="preload" as="style" onload="this.rel='stylesheet'" href="{{ $css }}">
@empty
@endforelse

<style>
	.progressive {
		background: transparent;
	}
	#colorlib-aside .colorlib-footer ul {
		background: #444 !important;
	}
</style>
