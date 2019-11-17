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

		<div class="form-group @if ($errors->has('name')) has-error @endif">
			{!! Form::label('name', $crudName.' Name', []) !!}
			{!! $label_required ?? '' !!}

			{!! Form::text('name', old('name'), [
						'class'			=> 'form-control',
						'placeholder'	=> 'Please enter role name (no whitespace)..'
			]) !!}

			<p class="help-block text-red">{{ $errors->first('name') }}</p>
		</div>

		<div class="form-group @if ($errors->has('display_name')) has-error @endif">
			{!! Form::label('display_name', 'Display Name', []) !!}

			{!! Form::text('display_name', old('display_name'), [
						'class'			=> 'form-control',
						'placeholder'	=> 'Please enter role display name..'
			]) !!}


			<p class="help-block text-red">{{ $errors->first('display_name') }}</p>
		</div>

		<div class="form-group @if ($errors->has('description')) has-error @endif">
			{!! Form::label('description', 'Role Description', []) !!}

			{!! Form::textarea('description', old('description'), [
						'class'			=> 'form-control no-resize',
						'placeholder'	=> 'Please enter role description..',
						'size'			=> '6x2'
			]) !!}

			<p class="help-block text-red">{{ $errors->first('description') }}</p>
		</div>

		@isset($menus)
			<div class="form-group @if ($errors->has('menus')) has-error @endif">
				{!! Form::label('menus', 'Select Menus', []) !!}

				{!! Form::select('menus[]', $menus, (isset($Model) && isset($Model->menus) ? $Model->menus->pluck('id')->toArray() : old('menus')), [
							'id'				=> 'menus',
							'class'				=> 'form-control',
							'data-placeholder'	=> 'Please select menus',
							'multiple'
				]) !!}

				<p class="help-block text-red">{{ $errors->first('menus') }}</p>
			</div>
		@endisset

		@isset($status_data)
			<div class="form-group @if ($errors->has('status')) has-error @endif">
				{!! Form::label('status', 'Select Status', []) !!}
				{!! $label_required ?? '' !!}

				{!! Form::select('status', $BaseLibrary->withEmpty($status_data), old('status'), [
							'class'				=> 'form-control',
							'data-placeholder'	=> 'Select Status'
				]) !!}

				<p class="help-block text-red">{{ $errors->first('status') }}</p>
			</div>
		@endisset

		<button type="submit" class="btn btn-success btn-sm">{!! $icon ?? '' !!} {{ $title ?? '' }}</button>
		<button name="_submit_redirect" value="{!! Route::has($resource.'.create') ? action($crudControllerName.'@create') : url('/') !!}" type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Save and Create New">{!! $BaseLibrary->reloadIcon ?? '' !!} Save and Create New</button>

	{!! Form::close() !!}

@endsection