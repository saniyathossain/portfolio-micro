
<ol class="breadcrumb bg-ash pad0B mrg0B hidden-print">
	@php
		$number_uri_segments = substr_count(request()->path(), '/');
		$prefix_list         = ['acl'];
		$path                = request()->segment(1);
	@endphp

	@for ($i = 1; $i < ($number_uri_segments + 2); $i++)

		@php
			$uri_segment_slug	= request()->segment($i);
			$uri_segment		= str_slug($uri_segment_slug);
			// $uri_text		= title_case(str_replace('-', ' ', $uri_segment_slug));
			$uri_text_term		= title_case(str_replace('-', ' ', $uri_segment_slug));
			$uri_text			= str_replace(array_map('ucfirst', $prefix_list), array_map('strtoupper', $prefix_list), $uri_text_term);
			$last_uri_segment	= str_slug(request()->segment($number_uri_segments + 1));

			if ($uri_segment == 'Superadmin' || $uri_segment == 'Admin'):
				$uri_segment = 'Dashboard';
			endif;
		@endphp

		@if (($uri_segment == $last_uri_segment) || (($uri_segment == 'Dashboard') && ($number_uri_segments == 0)))
			<li class="active">
				{{ $uri_text }}
			</li>
		@elseif (is_numeric($uri_segment))

		@else
			<li>
				@if ($uri_segment == 'Dashboard')
					<i class="fa fa-home font-black"></i> <a href="{{ url($path) }}">{{ $uri_text }}</a>
				@else
					@if ($path == $uri_segment_slug)
						@if (in_array($path, $prefix_list))
							<a href="{{ url($path) }}">{{ $uri_text }}</a>
						@endif
					@else
						<a href="{{ url($path.'/'.$uri_segment_slug) }}">{{ $uri_text }}</a>
					@endif
				@endif
			</li>
		@endif

	@endfor
</ol>
