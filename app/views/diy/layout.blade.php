<!DOCTYPE html>
<html>
<head>

<title>The Voltage Community</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="chrome=1" />

<link rel="stylesheet" media="screen" href="css/wheelsofsteel.css" />
<link rel="stylesheet" href="/assets/libraries/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/assets/libraries/bootstrap/css/bootstrap-responsive.min.css">
<link rel="stylesheet" media="screen" href="/assets/css/turntable.css" />
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/style2.css" type="text/css" media="screen">
<link rel="stylesheet" href="/assets/css/shelf.css">
<script src="script/soundmanager2.js"></script>
<script src="script/wheelsofsteel.js"></script>
<script src="/assets/js/jquery-1.8.0.min.js"></script>
<script src="/assets/libraries/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/libraries/infinite-scroll/jquery.infinitescroll.min.js"></script>
</head>

<body>
<!-- hide non-js fallback open state for #moreinfo, etc. -->
<script>document.body.className='has_js';</script>

<div id="top-navbar" class="navbar navbar-static-top navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="{{URL::to("/")}}">TheVoltageCommunity</a>
			<div class="nav-collapse collapse">
				<div class="span6 pull-right">

				@if(Auth::user())
				<ul class="nav span1 pull-right">
					<li class="dropdown pull-right">
						<a id="choose-instance" href="" role="button" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-important">{{count($notcount)}}</span><b class="caret"></b></a>
						
						<ul class="dropdown-menu notifications span4" role="menu">
							@foreach($notifications as $notification)
								@if($notification->post_id != 0)
								@if($notification->post->created_by == Auth::user()->id)
									@if($notification->activity == FALSE)
										@if($notification->viewed == FALSE)
											<li class="notificationsitem notread span3">
												<div class="span1">
														@if($notification->user->accountUser()->identifier == 0)
															<a href="{{ URL::action('UserController@visitAccount',array($notification->user->id)) }}">
																<img class="img-rounded" src="{{ url($notification->user->accountUser()->getImagePathname()) }}" alt="" width="35">
															</a>
														@else
														<a href="{{ URL::action('UserController@visitAccount',array($notification->user->id)) }}">
															<img class="img-rounded" src="{{ url($notification->user->accountUser()->facebookpic) }}" alt="" width="35">
														</a>
														@endif
													</div>
													<div class="span2 nottext">
														<a href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
															<p class="notificationfont">{{$notification->user->first_name}} {{$notification->body}}</p>
														</a>														
													</div>

													<div class="span1 readimg">
  									 				@if($notification->post->soundcloud_art != NULL)
														<img class="img-rounded pull-left" src="{{ url($notification->post->soundcloud_art) }}" alt="" width="35">
													@else
														<img class="img-rounded pull-left" src="{{ url($notification->post->youtube_art) }}" alt="" width="35">
													@endif
													</div>
											</li>

										@else
										
											<li class="notificationsitem span4">
													<div class="span1">
														@if($notification->user->accountUser()->identifier == 0)
															<a href="{{ URL::action('UserController@visitAccount',array($notification->user->id)) }}">
																<img class="img-rounded" src="{{ url($notification->user->accountUser()->getImagePathname()) }}" alt="" width="35">
															</a>
														@else
														<a href="{{ URL::action('UserController@visitAccount',array($notification->user->id)) }}">
															<img class="img-rounded" src="{{ url($notification->user->accountUser()->facebookpic) }}" alt="" width="35">
														</a>
														@endif
													</div>
													<div class="span2 nottext">
														<a href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
															<p class="notificationfont">{{$notification->user->first_name}} {{$notification->body}}</p>
														</a>
														
													</div>

													<div class="span1 readimg">
  									 				@if($notification->post->soundcloud_art != NULL)
														<img class="img-rounded pull-left" src="{{ url($notification->post->soundcloud_art) }}" alt="" width="35">
													@else
														<img class="img-rounded pull-left" src="{{ url($notification->post->youtube_art) }}" alt="" width="35">
													@endif
													</div>
											</li>
											

										@endif
									@endif
								@endif
								@endif
							@endforeach
							@foreach($following as $follow)
								<li class="notificationsitem span3">
									{{$follow->account->user->notification}}
								</li>
							@endforeach
						</ul>
					</li>
				</ul>
				@endif
				@if (Auth::check())
					<ul class="nav span3 pull-right">
						<li class="dropdown pull-right">
							<a id="choose-instance" href="" role="button" class="dropdown-toggle" data-toggle="dropdown">
							@if(Auth::user()->accountUser()->image_id != 0 or Auth::user()->accountUser()->facebookpic == NULL )
								<img src="{{ url(Auth::user()->accountUser()->getImagePathname()) }}" width="25" alt="">
							@else
								<img src="{{ url(Auth::user()->accountUser()->facebookpic) }}" width="25" alt="">
							@endif
							@if(Auth::user())
							 Welcome {{Auth::user()->first_name}} {{Auth::user()->last_name}}
							@endif
							<b class="caret"></b></a>

							<ul class="dropdown-menu" role="menu" aria-labelledby="choose-instance">
								<li>
									@if(Auth::user())
									<a href="{{ URL::action('UserController@showAccount',array(Auth::user()->id)) }}"><i class="icon-eye-open"> View Account</i></a>
									@endif

								</li>
								<li><a href=""><i class="icon-key"> Change password</i></a></li>
								<li><a href="{{ URL::action('PostController@create') }}"><i class="icon-plus"> Create post</i></a></li>
							</ul>
						</li>
					</ul>

					<ul class="nav span1 pull-right">
					<li>
						<a href="{{ URL::action('HomeController@showActivity') }}"><i class="icon-th-list"></i></a>
					</li>
				</ul>
				@endif
				<ul class="nav pull-right">
					@if (Auth::check())
						<li><a href="{{ URL::to('logout')}}">Logout</a></li>
					@else
						<li><a href="{{ URL::route('login') }}">Login</a></li>
					@endif
				</ul>
			</div>
			</div>
		</div>
	</div>
</div>


<div class="container">
@yield('content')
</div>

	<footer class="site-footer">
	

		<hr>

		@yield('footer')

		<p>&copy; 2013 Thevoltagecommunity</p>

	</footer>   

</div>

 

</body>
</html>