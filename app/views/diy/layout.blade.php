<!DOCTYPE html>
<html>
<head>

<title>The Voltage Community</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="chrome=1" />
<link rel="shortcut icon" type="image/x-icon" href="/favicon1.ico">

<link rel="stylesheet" media="screen" href="css/turntable.css" />
<link rel="stylesheet" href="/assets/libraries/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/assets/libraries/bootstrap/css/bootstrap-responsive.min.css">
<link rel="stylesheet" media="screen" href="/assets/css/turntable.css" />
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/style2.css" type="text/css" media="screen">
<link rel="stylesheet" href="/assets/css/shelf.css">
<script src="script/soundmanager2.js"></script>
<script src="script/turntable.js"></script>
<script src="/assets/js/jquery-1.8.0.min.js"></script>
<script src="/assets/libraries/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/libraries/infinite-scroll/jquery.infinitescroll.min.js"></script>
</head>

<body class="has_js">
<!-- hide non-js fallback open state for #moreinfo, etc. -->
<script>document.body.className='has_js';</script>

<div class="navbar navbar-static-top navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
      		
      		<a class="brand offset2" href="#"></a>
			<div class="nav-collapse">
				<ul class="nav pull-right itemsnav">
					
				<li>
          	 	@if(Auth::user())
					<form class="navbar-search " id="searchusers" action="">
						<input type="text" class="search-query span3" id="searchDatauser" placeholder="Search users" width="400">
						<ul id="suggestions" class="nav span4">
               			</ul>
					</form>
				@endif
			</li>
			@if(Auth::check())
			<li>
				<a href="{{ URL::action('HomeController@showActivity') }}"><i class="icon-th-list"></i></a>
			</li>
			@endif
			@if(Auth::check())
					<li class="dropdown pull-right">
							<a id="choose-instance" href="" role="button" class="dropdown-toggle" data-toggle="dropdown">
								@if(Auth::user()->accountUser()->image_id != 0 or Auth::user()->accountUser()->facebookpic == NULL )
									<img class="barpic" src="{{ url(Auth::user()->accountUser()->getImagePathname()) }}" width="25" alt="">
								@else
									<img class="barpic" src="{{ url(Auth::user()->accountUser()->facebookpic) }}" width="25" alt="">
								@endif
								
								@if(Auth::user())
									 Welcome {{Auth::user()->first_name}} {{Auth::user()->last_name}}
								@endif
								<b class="caret"></b></a>
								
								<ul class="dropdown-menu" role="menu" aria-labelledby="choose-instance">
									<li>
										@if(Auth::user())
											<a href="{{ URL::action('UserController@showAccount',array(Auth::user()->id)) }}"> View Account</i></a>
										@endif
									</li>
									<li><a href="{{ URL::action('PostController@create') }}"> Create post</i></a></li>
								</ul>
					</li>
					@endif
			@if(Auth::check())
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
														@if($notification->post->type == 'graph')
															<a href="{{URL::action('PostController@showGraph',array($notification->post_id)) }}">
																<p class="notificationfont">{{$notification->user->first_name}} {{$notification->body}}</p>
															</a>
														@else
															<a href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
																<p class="notificationfont">{{$notification->user->first_name}} {{$notification->body}}</p>
															</a>
														@endif														
													</div>

													<div class="span1 readimg">
													@if($notification->post->type == 'graph')
														<img class="avatar" src="/{{ $notification->post->image->getSize('original')->getPathname() }}" alt="" width="35">
													@else
  									 					@if($notification->post->soundcloud_art != NULL)
															<img class="img-rounded pull-left" src="{{ url($notification->post->soundcloud_art) }}" alt="" width="35">
														@else
															<img class="img-rounded pull-left" src="{{ url($notification->post->youtube_art) }}" alt="" width="35">
														@endif
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
														@if($notification->post->type == 'graph')
														<a href="{{URL::action('PostController@showGraph',array($notification->post_id)) }}">
															<p class="notificationfont">{{$notification->user->first_name}} {{$notification->body}}</p>
														</a>
														@else
														<a href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
															<p class="notificationfont">{{$notification->user->first_name}} {{$notification->body}}</p>
														</a>
														@endif
													</div>

													<div class="span1 readimg">
														@if($notification->post->type == 'graph')
														<img class="avatar" src="/{{ $notification->post->image->getSize('original')->getPathname() }}" alt="" width="35">
														@else
  									 						@if($notification->post->soundcloud_art != NULL)
																<img class="img-rounded pull-left" src="{{ url($notification->post->soundcloud_art) }}" alt="" width="35">
															@else
																<img class="img-rounded pull-left" src="{{ url($notification->post->youtube_art) }}" alt="" width="35">
															@endif
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
					@endif
          	@if (Auth::check())
				<li class="pull-right"><a href="{{ URL::to('logout')}}">Logout</a></li>
		 	@else
				<li><a href="{{ URL::route('login') }}">Login</a></li>
			@endif
        	</ul>
		</div><!-- /.nav-collapse -->
	</div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div>


<div class="container">
@yield('content')
</div>

	<footer class="site-footer">
	

		<div class="span2 logofooter pull-right">
			<img src="/images/logovoltage.png" width="200">
		</div>

		<div class="span4">
			<img class="devices" src='/images/devices.png' width="300px" height="200">
		</div>

	</footer>   

</div>

<script>

$("#suggestions").hide();
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41789212-1', 'thevoltagecommunity.com');
  ga('send', 'pageview');

</script>

 

</body>
</html>