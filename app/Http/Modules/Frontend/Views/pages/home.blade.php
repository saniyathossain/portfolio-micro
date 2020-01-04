@php
    use Carbon\Carbon;
@endphp

@extends($BaseLibrary->moduleFrontendViewPartialMaster)

@section('content')
	<body>
		<div id="colorlib-page">
			<div class="container-wrap">
			<a href="{!! $BaseLibrary->hrefHash !!}" class="js-colorlib-nav-toggle colorlib-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
			<aside id="colorlib-aside" role="complementary" class="border js-fullheight">
				<div class="text-center">
					{{-- <div class="author-img" style="background-image: url({!! $BaseLibrary->themeJacksonPath !!}images/about.jpg);"></div> --}}
					{{-- <div class="progressive__bg progressive--not-loaded author-img" data-progressive="{!! $BaseLibrary->themeJacksonPath !!}images/about.jpg" data-progressive-sm="{!! $BaseLibrary->themeJacksonPath !!}images/about.jpg" style="background-image: url('{!! $BaseLibrary->themeJacksonPath !!}images/about.jpg');"></div> --}}

					{!! $BaseLibrary->renderImage($BaseLibrary->assetsImagePath.'formal.jpg', 5, ['class' => 'author-img img-responsive']) !!}

					<h1 id="colorlib-logo"><a href="{!! url('/') !!}">{!! $me->fullname ?? '' !!}</a></h1>
					<span class="position"><a href="{!! $BaseLibrary->hrefHash !!}">{!! $me->designation ?? '' !!}</a> in {!! $me->country ?? '' !!}</span>
				</div>
				<nav id="colorlib-main-menu" role="navigation" class="navbar">
					<div id="navbar" class="collapse">
						<ul>
							<li class="active"><a href="{!! $BaseLibrary->hrefHash !!}" data-nav-section="home">Home</a></li>
							<li><a href="{!! $BaseLibrary->hrefHash !!}" data-nav-section="about">About</a></li>
							<li><a href="{!! $BaseLibrary->hrefHash !!}" data-nav-section="skills">Skills</a></li>
							<li><a href="{!! $BaseLibrary->hrefHash !!}" data-nav-section="education">Education</a></li>
							<li><a href="{!! $BaseLibrary->hrefHash !!}" data-nav-section="experience">Experience</a></li>
							<li><a href="{!! $BaseLibrary->hrefHash !!}" data-nav-section="contact">Contact</a></li>
						</ul>
					</div>
				</nav>

				<div class="colorlib-footer">
					<p>
						<small>&copy; Copyright {!! date('Y') !!} All rights reserved.
					<ul>
                        @if (isset($me->github_link) && !empty($me->github_link))
                            <li><a target="_blank" href="{{ sprintf('//%s', $me->github_link) }}"><i class="icon-github"></i></a></li>
                        @endif
                        @if (isset($me->linkedin_link) && !empty($me->linkedin_link))
						    <li><a target="_blank" href="{{ sprintf('//%s', $me->linkedin_link) }}"><i class="icon-linkedin2"></i></a></li>
                        @endif
					</ul>
				</div>
			</aside>

			<div id="colorlib-main">

				<section class="colorlib-about" data-section="about">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-12">
								<div class="row row-bottom-padded-sm animate-box" data-animate-effect="fadeInLeft">
									<div class="col-md-12">
										<div class="about-desc">
											<span class="heading-meta">About</span>
											<h2 class="colorlib-heading">Who Am I?</h2>
											<p class="text-justify"><strong>I'm {!! $me->fullname ?? '' !!}</strong>. {!! $me->about ?? '' !!}</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 animate-box" data-animate-effect="fadeInLeft">
										<div class="services color-1">
											<span class="icon2"><i class="icon-bulb"></i></span>
											<h3>Responsive Design</h3>
										</div>
									</div>
									<div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
										<div class="services color-2">
											<span class="icon2"><i class="icon-globe-outline"></i></span>
											<h3>Web Development</h3>
										</div>
									</div>
									<div class="col-md-3 animate-box" data-animate-effect="fadeInTop">
										<div class="services color-3">
											<span class="icon2"><i class="icon-data"></i></span>
											<h3>Software</h3>
										</div>
									</div>
									<div class="col-md-3 animate-box" data-animate-effect="fadeInBottom">
										<div class="services color-4">
											<span class="icon2"><i class="icon-phone3"></i></span>
											<h3>Application</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<section class="colorlib-skills" data-section="skills">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta">My Specialty</span>
								<h2 class="colorlib-heading animate-box">My Skills</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
								{!! $me->skills !!}

                                <br><br>

                                @isset ($technical_skills)
                                    @forelse ($technical_skills as $skill)
                                        <div class="col-md-6 animate-box" data-animate-effect="fadeIn{!! (($loop->iteration) % 2 != 0) ? 'Left' : 'Right' !!}">
                                            <div class="progress-wrap">
                                                <h3>{!! $skill->icon ?? '' !!} {!! $skill->name ?? '' !!}</h3>
                                                <div class="progress">
                                                    <div class="progress-bar color-{!! $loop->iteration !!}"
                                                        role="progressbar"
                                                        aria-valuenow="{!! $skill->percentage ?? '' !!}"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                        style="width:{!! $skill->percentage ?? '' !!}%"
                                                    >
                                                        <span>{!! $skill->percentage ?? '' !!}%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                @endisset
						    </div>
						</div>
					</div>
				</section>

				<section class="colorlib-education" data-section="education">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta">Education</span>
								<h2 class="colorlib-heading animate-box">Education</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
								<div class="fancy-collapse-panel">
									<div class="panel-group text-justify" id="accordion" role="tablist" aria-multiselectable="true">
										@isset ($education_data)
											@forelse ($education_data as $education)
												<div class="panel panel-default">
													<div class="panel-heading" role="tab" id="heading_{!! $loop->iteration !!}">
														<h4 class="panel-title">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse_{!! $loop->iteration !!}" aria-expanded="true" aria-controls="collapse_{!! $loop->iteration !!}">{!! $education->education_level ?: '' !!} in {!! $education->education_department !!}</a>
														</h4>
													</div>

													<div id="collapse_{!! $loop->iteration !!}" class="panel-collapse collapse {!! $loop->iteration == 1 ? 'in' : '' !!}" role="tabpanel" aria-labelledby="heading_{!! $loop->iteration !!}">
														 <div class="panel-body">
															<div class="row">
																<div class="col-md-6 pull-left text-left">
																	<p>{!! $education->institute_name ?: '' !!}</p>
																</div>
																<div class="col-md-6 pull-right text-right">
																	<p>{!! (new Carbon($education->start_date))->format('Y') !!} to {!! isset($education->end_date) ? (new Carbon($education->end_date))->format('Y') : 'Continuing' !!}</p>
																</div>

																{!! $clearfix ?? '' !!}
															</div>
														 </div>
													</div>
												</div>
											@empty
											@endforelse
										@endisset
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<section class="colorlib-experience" data-section="experience">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta">Experience</span>
								<h2 class="colorlib-heading animate-box">Professional Experience</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="timeline-centered">
									@isset ($professional_experiences)
										@forelse ($professional_experiences as $experience)
											<article class="timeline-entry animate-box" data-animate-effect="fadeIn{!! (($loop->iteration) % 2 != 0) ? 'Left' : 'Right' !!}">
												<div class="timeline-entry-inner">
													<div class="timeline-icon color-{!! $loop->iteration !!}">
														{!! $experience->icon ?? '' !!}
													</div>

													<div class="timeline-label">
														<h2 class="pull-left text-left"><a href="{!! $BaseLibrary->hrefHash ?? '' !!}">{!! $experience->post_name ?? '' !!}</a><br><span>{!! (new Carbon($experience->start_date))->format('F Y') !!} to {!! isset($experience->end_date) ? (new Carbon($experience->end_date))->format('F Y') : 'Continuing' !!}</span></h2>
														<h2 class="pull-right text-right"><a target="_blank" href="{!! $experience->company_link !!}">{!! $experience->company_name ?? '' !!}</a><br><span>{!! $experience->company_location ?? '' !!}</span></h2>
														{!! $clearfix ?? '' !!}

														<p class="text-justify">{!! $experience->experience ?? '' !!}</p>
													</div>
												</div>
											</article>
										@empty
										@endforelse
									@endisset

									<article class="timeline-entry begin animate-box" data-animate-effect="fadeInBottom">
										<div class="timeline-entry-inner">
											<div class="timeline-icon color-none">
											</div>
										</div>
									</article>
								</div>
							</div>
						</div>
					</div>
				</section>

				<section class="colorlib-contact" data-section="contact">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta">Get in Touch</span>
								<h2 class="colorlib-heading">Contact</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="colorlib-feature colorlib-feature-sm animate-box" data-animate-effect="fadeInLeft">
									<div class="colorlib-icon">
										<i class="icon-globe-outline"></i>
									</div>
									<div class="colorlib-text">
										<p><a target="_blank" href="mailto:{{ $me->email ?? '' }}">{!! $me->email ?? '' !!}</a></p>
									</div>
								</div>

								<div class="colorlib-feature colorlib-feature-sm animate-box" data-animate-effect="fadeInLeft">
									<div class="colorlib-icon">
										<i class="icon-phone"></i>
									</div>
									<div class="colorlib-text">
										<p><a target="_blank" href="tel:{{ $me->phone ?? '' }}">{!! $me->phone ?? '' !!}</a></p>
									</div>
								</div>
							</div>
							{{-- <div class="col-md-7 col-md-push-1">
								<div class="row">
									<div class="col-md-10 col-md-offset-1 col-md-pull-1 animate-box" data-animate-effect="fadeInRight">
										<form action="">
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Name">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Email">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Subject">
											</div>
											<div class="form-group">
												<textarea name="" id="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
											</div>
											<div class="form-group">
												<input type="submit" class="btn btn-primary btn-send-message" value="Send Message">
											</div>
										</form>
									</div>

								</div>
							</div> --}}
						</div>
					</div>
				</section>

			</div><!-- end:colorlib-main -->
		</div><!-- end:container-wrap -->
		</div><!-- end:colorlib-page -->

		@includeIf($BaseLibrary->moduleFrontendViewPartialScripts)

	</body>
@endsection
