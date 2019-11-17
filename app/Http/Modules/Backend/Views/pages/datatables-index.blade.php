@extends($BaseLibrary->moduleCoreViewPartialMaster)

@section('content')

	@include($BaseLibrary->moduleCoreViewPartialBreadcrumb)

	<section class="content-header">
		<h1 class="mrg0A pad0A pull-left">{{ $title ?? '' }}</h1>

		@isset($return_url)
			<div class="pull-right">
				<a href="{!! $return_url !!}"><button type="button" class="btn btn-primary btn-sm">Back</button></a>
			</div>
		@endisset

		<div class="clearfix"></div>
	</section>

	<section class="content">
		<div class="box box-primary mrg0B">
			<div class="box-body mrg0T">

				@php
					$request_segment	= request()->segment(2);
					$button_title		= 'Add '.str_singular(str_replace('-', ' ', $request_segment));
					$current_route		= Route::current()->uri;
				@endphp

				<a href="{{ url($current_route.'/create') }}" class="btn btn-primary btn-sm pull-left">
					<i class="ion-plus-round"></i> {{ $button_title }}
				</a>

				@if ($current_route == 'acl/menus')
					&nbsp;&nbsp;
					<a class="btn btn-primary btn-sm" role="button" data-toggle="collapse" href="#aclMenusTreeView" aria-expanded="false" aria-controls="aclMenusTreeView">
						<i class="fa fa-list-ul"></i> View Menu Tree
					</a>

					<div class="collapse mrg10T" id="aclMenusTreeView">
						<ul class="list-group">
							@isset ($menus)
								@forelse ($menus as $menu)
									<li class="list-group-item">{!! $menu !!}</li>
								@empty
									<li>No Menu Available</li>
								@endforelse
							@endisset
						</ul>
					</div>
				@endif

				<div class="clearfix"></div>

				<div class="table-responsive nowrap">
					@isset($dataTable)
						<br/>
						{!! $dataTable->table(['class' => 'table table-responsive table-bordered table-striped table-hover']) !!}
					@endisset
				</div>

			</div>
		</div>
	</section>

	@isset($dataTable)
		{!! $dataTable->scripts() !!}
	@endisset

@endsection
