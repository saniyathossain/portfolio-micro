@guest
	@extends($BaseLibrary->moduleCoreViewPartialMaster)

	@section('content')
		<div class="jumbotron vertical-center" id="bg-345D78">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">

						@if (isset($user_agent_ie) && $user_agent_ie != false)
							<div class="box box-primary background-345D78" align="center">
								<div class="pad15A"><span class="blink_text">{!! $BaseLibrary->messageBrowserIeNotRecommentded !!}</span></div>
							</div>
						@else
							<div class="box box-primary">
								<div class="box-header text-center mrg15T">
									{!! $BaseLibrary->renderImage($path = $BaseLibrary->assetsImagePath.'icddrb logo.png', $size = 5, $attr = ['alt' => 'Logo', 'width' => '160px', 'height' => '160px', 'class' => 'center-block img-responsive progressive__bg progressive--not-loaded']) !!}
								</div>

								<div class="box-body pad25A">
									{!! Form::open(['route' => 'auth.postSignin', 'method' => 'post']) !!}

										<div class="form-group has-feedback @if ($errors->has('username')) has-error @endif">
											{!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Please enter your suchona username..', 'autofocus']) !!}
											<i class="ion-person form-control-feedback"></i>

											<p class="help-block text-red">{{ $errors->first('username') }}</p>
										</div>

										<div class="form-group has-feedback @if ($errors->has('password')) has-error @endif">
											{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Please enter your suchona password..']) !!}
											<span class="ion-ios-locked form-control-feedback"></span>

											<p class="help-block text-red">{{ $errors->first('password') }}</p>
										</div>

										<button type="submit" class="btn btn-success btn-block btn-lg"><i class="fa fa-sign-in"></i> {{ $title }}</button>

									{!! Form::close() !!}
								</div>

								<div class="box box-primary background-345D78" align="center">
									<div class="pad15A">
										{!! $BaseLibrary->messageEmergencyContact !!}
									</div>
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	@endsection
@endguest