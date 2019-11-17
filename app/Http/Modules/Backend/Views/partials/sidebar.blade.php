@auth
	@php
		$menus           = (session()->has('auth_user_menus') && session('auth_user_menus')->isNotEmpty()) ? session('auth_user_menus', collect())->toArray() : resolve($BaseLibrary->moduleAclModelMenus)->getMenus()->get()->toArray();
		$dynamic_menu    = $BaseLibrary->dynamicMenu($menus);
	@endphp

	<aside class="main-sidebar">
		<section class="sidebar">
			<div class="user-panel">
				<div class="pull-left image">
					<i class="fa ion-ios-person fa-4x text-green"></i>
				</div>

				<div class="pull-left info">
					<a href="javascript:void()"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>

			<ul class="sidebar-menu" data-widget="tree">
				{!! $dynamic_menu ?? '' !!}
			</ul>
		</section>
	</aside>
@endauth