@auth
	<header class="main-header">
		<a href="{!! url('dashboard') !!}" class="logo" id="bg-345D78">
			<span class="logo-lg">
				{{ $BaseLibrary->renderImage($path = $BaseLibrary->assetsImagePath.'icddrb-logo-transparent.png', $size = 5, $attr = ['alt' => 'Logo', 'width' => '150px', 'height' => '150px', 'class' => 'center-block img-responsive progressive__bg progressive--not-loaded']) }}
			</span>
		</a>

		<nav class="navbar navbar-static-top">
			<a href="javascript:void(0)" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
							{!! $BaseLibrary->personIcon !!}
							{!! auth()->user()->username ?? '' !!}
						</a>

						<ul class="dropdown-menu">
							<li class="user-footer">
								<div class="pull-right">
									<a href="{!! route('auth.getSignout') !!}" class="btn btn-danger btn-sm">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
@endauth