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

		<div class="form-group @if ($errors->has('username')) has-error @endif">
			{!! Form::label('username', 'Username', []) !!}
			{!! $label_required ?? '' !!}

			<div class="input-group">
				{!! Form::text('username', old('username'), [
							'class'			=> 'form-control',
							'placeholder'	=> 'Please enter username..'
				]) !!}

				<span class="input-group-addon">{!! $BaseLibrary->personIcon ?? '' !!}</span>

			</div>

			<p class="help-block text-red">{{ $errors->first('username') }}</p>
		</div>

		<div class="form-group @if ($errors->has('fullname')) has-error @endif">
			{!! Form::label('fullname', 'Full Name', []) !!}

			<div class="input-group">
				{!! Form::text('fullname', old('fullname'), [
							'class'			=> 'form-control',
							'placeholder'	=> 'Please enter Fullname..'
				]) !!}

				<span class="input-group-addon">{!! $BaseLibrary->personIcon ?? '' !!}</span>
			</div>

			<p class="help-block text-red">{{ $errors->first('fullname') }}</p>
		</div>

		<div class="form-group @if ($errors->has('employee_id')) has-error @endif">
			{!! Form::label('employee_id', 'Employee ID', []) !!}

			<div class="input-group">
				{!! Form::text('employee_id', old('employee_id'), [
							'class'			=> 'form-control',
							'placeholder'	=> 'Please enter Employee ID..'
				]) !!}

				<span class="input-group-addon">{!! $BaseLibrary->codeIcon ?? '' !!}</span>

			</div>

			<p class="help-block text-red">{{ $errors->first('employee_id') }}</p>
		</div>

		<div class="form-group @if ($errors->has('email')) has-error @endif">
			{!! Form::label('email', 'Email Address', []) !!}
			{!! $label_required ?? '' !!}

			<div class="input-group">
				{!! Form::email('email', old('email'), [
							'class'			=> 'form-control',
							'placeholder'	=> 'Please enter email address..'
				]) !!}

				<span class="input-group-addon">{!! $BaseLibrary->emailIcon ?? '' !!}</span>
			</div>

			<p class="help-block text-red">{{ $errors->first('email') }}</p>
		</div>

		@isset($roles)
			<div class="form-group @if ($errors->has('roles')) has-error @endif">
				{!! Form::label('roles', 'Select User Role', []) !!}

				{!! Form::select('roles[]', $roles, (isset($Model) && isset($Model->roles) ? $Model->roles->pluck('id')->toArray() : old('roles')), [
							'id'				=> 'roles',
							'class'				=> 'form-control',
							'data-placeholder'	=> 'Please select user role',
							'multiple'
				]) !!}

				<p class="help-block text-red">{{ $errors->first('roles') }}</p>
			</div>
		@endisset

		@isset($gender_data)
			<div class="form-group @if ($errors->has('gender')) has-error @endif">
				{!! Form::label('gender', 'Select Gender', []) !!}

				{!! Form::select('gender', $BaseLibrary->withEmpty($gender_data), old('gender'), [
							'class'				=> 'form-control',
							'data-placeholder'	=> 'Select gender'
				]) !!}

				<p class="help-block text-red">{{ $errors->first('gender') }}</p>
			</div>
		@endif

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
		<button name="_submit_redirect" value="{!! Route::has($resource.'.create') ? action($crudControllerName.'@create') : url('/') !!}" type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Save and Create New">{!! $BaseLibrary->reloadIcon ?? '' !!} {{ 'Save and Create New' }}</button>

	{!! Form::close() !!}

@endsection