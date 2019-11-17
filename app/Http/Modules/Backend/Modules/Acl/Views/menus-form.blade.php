@extends($BaseLibrary->moduleCoreViewPartialContents)

@section('contents')

	@isset($Model)

		{!! Form::model($Model, [
				'name'				=> camel_case($crudName).'Form',
				'id'				=> camel_case($crudName).'Form',
				'action'			=> [$crudControllerName.'@update', $Model->id],
				'data-id'			=> $Model->id,
				'method'			=> 'put',
				'data-redirectUrl'	=> action($crudControllerName.'@index')
		]) !!}

	@else

		{!! Form::open([
				'name'				=> camel_case($crudName).'Form',
				'id'				=> camel_case($crudName).'Form',
				'action'			=> $crudControllerName.'@store',
				'method'			=> 'post',
				'data-redirectUrl'	=> action($crudControllerName.'@index')
		]) !!}

	@endisset

		{{-- {!! Form::hidden('menu_order', (isset($Model) ? $Model->menu_order : 0), []) !!} --}}
		{{-- {!! Form::hidden('menu_level', (isset($Model) ? $Model->menu_level : 0), []) !!} --}}

		<div class="form-group">
			{!! Form::label('name', $crudName.' Menu Name', []) !!}
			{!! $label_required ?? '' !!}

			{!! Form::text('name', old('name'), [
						'class'			=> 'form-control',
						'placeholder'	=> 'Please enter menu name..'
			]) !!}

			<p class="help-block text-red">{{ $errors->first('name') }}</p>
		</div>

		<div class="form-group">
			{!! Form::label('description', 'Menu Description', []) !!}

			{!! Form::textarea('description', old('description'), [
						'class'			=> 'form-control no-resize',
						'placeholder'	=> 'Please enter menu description..',
						'size'			=> '6x2'
			]) !!}

			<p class="help-block text-red">{{ $errors->first('description') }}</p>
		</div>

		<div class="form-group">
			{!! Form::label('url', 'Menu URL', []) !!}

			{!! Form::text('url', old('url'), [
						'class'			=> 'form-control',
						'placeholder'	=> 'Please enter menu url..'
			]) !!}

			<p class="help-block text-red">{{ $errors->first('url') }}</p>
		</div>

		@isset($menus)
			<div class="form-group @if ($errors->has('parent_menu')) has-error @endif">
				{!! Form::label('parent_menu', 'Select Parent Menu', []) !!}

				{!! Form::select('parent_menu', $BaseLibrary->withEmpty($menus), (isset($Model) ? $Model->parent_menu : null), [
							'class'				=> 'form-control',
							'data-placeholder'	=> 'Please select parent menu',
							'data-select-parent-menu-dropdown'
				]) !!}

				<p class="help-block text-red">{{ $errors->first('parent_menu') }}</p>
			</div>
		@endisset

		{{-- <div class="form-group @if ($errors->has('menu_position')) has-error @endif">
			{!! Form::label('menu_position', 'Select Menu Position', []) !!}

			{!! Form::select('menu_position', $BaseLibrary->withEmpty([1 => 'Before', 2 => 'After']), (isset($Model) ? $Model->menu_position : null), [
						'id'				=> 'menu_position',
						'class'				=> 'form-control',
						'data-placeholder'	=> 'Please select menu position'
			]) !!}

			<p class="help-block text-red">{{ $errors->first('menu_position') }}</p>
		</div>

		@isset($menu_order)
			<div class="form-group @if ($errors->has('selected_menu_order')) has-error @endif">
				{!! Form::label('selected_menu_order', 'Select Menu Order', []) !!}

				{!! Form::select('selected_menu_order', $BaseLibrary->withEmpty($menu_order), (isset($Model) ? $Model->selected_menu_order : null), [
							'id'				=> 'selected_menu_order',
							'class'				=> 'form-control',
							'data-placeholder'	=> 'Please select menu order',
							'data-select-menu-order-dropdown'
				]) !!}

				{!! Form::hidden('selected_menu_order', (isset($Menu) ? $Menu->selected_menu_order : null), [
							'id'				=> 'selected_menu_order',
							'class'				=> 'form-control',
							'data-placeholder'	=> 'Please select menu order',
							'data-select-menu-order-hidden'
				]) !!}

				<p class="help-block text-red">{{ $errors->first('selected_menu_order') }}</p>
			</div>
		@endisset --}}

		@isset($icons)
			<div class="form-group @if ($errors->has('icon')) has-error @endif">
				{!! Form::label('icon', 'Select Icons', []) !!}

				{!! Form::select('icon', $BaseLibrary->withEmpty($icons), (isset($Model) ? $Model->icon : null), [
							'class'				=> 'form-control',
							'data-placeholder'	=> 'Please select icon for menu'
				]) !!}

				<p class="help-block text-red">{{ $errors->first('icon') }}</p>
			</div>
		@endisset

		@isset($status_data)
			<div class="form-group @if ($errors->has('status')) has-error @endif">
				{!! Form::label('status', 'Select Status', []) !!}
				{!! $label_required ?? '' !!}

				{!! Form::select('status', $BaseLibrary->withEmpty($status_data), null, [
							'class'				=> 'form-control',
							'data-placeholder'	=> 'Select Status'
				]) !!}

				<p class="help-block text-red">{{ $errors->first('status') }}</p>
			</div>
		@endisset

		<button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="Save">{!! $icon ?? '' !!} Save</button>
		<button name="_submit_redirect" value="{!! Route::has($resource.'.create') ? action($crudControllerName.'@create') : url('/') !!}" type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Save and Create New">{!! $reloadIcon ?? '' !!} Save and Create New</button>

	{!! Form::close() !!}

@endsection