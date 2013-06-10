<?php header('X-Frame-Options SAMEORIGIN, GOFORIT'); ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<!-- Info -->
	<title>The Voltage Community</title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicon1.ico">
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="/assets/libraries/bootstrap-wysihtml5/css/bootstrap-wysihtml5.css">
	<link rel="stylesheet" href="/assets/libraries/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/libraries/bootstrap/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="/assets/css/style.css">
	<link rel="stylesheet" href="/assets/css/style2.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/assets/css/shelf.css">
	<link rel="stylesheet" href="/assets/libraries/bootstrap-chosen/css/chosen.css">
	<link rel="stylesheet" href="/assets/libraries/select2/select2.css">
	<link rel="stylesheet" href="/assets/libraries/Font-Awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/libraries/ajax-scroll/src/css/jquery.ias.css">
	<link href="/assets/libraries/lightbox/assets/css/docs.css" rel="stylesheet" />
	 <link href="/assets/libraries/lightbox/assets/js/google-code-prettify/prettify.css" rel="stylesheet" />
	 <link href="/assets/libraries/lightbox/src/css/ilightbox.css" rel="stylesheet" />

	<script src="/assets/libraries/lightbox/assets/js/jquery.js"></script>
	

</head>

<body>

<div class="navbar navbar-static-top navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
      		
      		<a class="brand offset2 titlehead" href="{{URL::to("/")}}"><img src="/images/lightninglight.png" width="30"></a>
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
									<li><a href="{{ URL::action('PlaylistController@index') }}"><i class="icon-list"> My playlists</i></a></li>
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
	
		@yield('footer')
		<div class="span2 logofooter pull-right">
			<img src="/images/logovoltage.png" width="200">
		</div>
		<div class="span4">
			
		</div>


	</footer>   

</div><!-- .container -->


<!-- Scripts -->

<script src="/assets/libraries/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/assets/libraries/nestedSortable/jquery.mjs.nestedSortable.js"></script>
<script src="/assets/libraries/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/libraries/bootstrap-wysihtml5/js/wysihtml5-0.3.0.js"></script>
<script src="/assets/libraries/bootstrap-wysihtml5/js/bootstrap-wysihtml5.js"></script>
<script src="/assets/libraries/bootstrap-chosen/js/chosen.jquery.js"></script>
<script src="/assets/libraries/select2/select2.js"></script>
<script src="/assets/js/jquery.form.js"></script>
<script src="/assets/js/script.js"></script>
<script src="/assets/libraries/ajax-scroll/src/jquery-ias.js"></script>
<script src="/assets/libraries/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script src="/assets/libraries/masonry2/jquery.masonry.min.js"></script>
<script src="/assets/libraries/tinycon/tinycon.min.js"></script>
<script type="text/javascript" src="/assets/js/sound.js"></script>
<script type="text/javascript" src="/assets/libraries/lightbox/assets/js/css_browser_selector.min.js"></script>
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

	<script type="text/javascript" async defer src="http://iprodev.com/projects.php?p=ilightbox"></script>
	<script src="/assets/libraries/lightbox/assets/js/google-code-prettify/prettify.js"></script>
    <script src="/assets/libraries/lightbox/src/js/jquery.mousewheel.js"></script>
    <script src="/assets/libraries/lightbox/src/js/ilightbox.js"></script>


<script>

		var a=eval,c='$(46).54(m(){m j(){g=!1;26(f);e.1Z("3a")}m h(b,a){b=$("<1C />",{"J":"39 3q"}).H(b);$.r([{l:b,t:"I",3f:a?a:20}],{D:"16-1x 1R-39",Z:1,1d:!0,38:{37:!1},1y:{37:!1},X:{1t:!1},15:{12:!1},28:{2a:m(a){$(".G",a.1O).B(m(){$(".G",a.1O).5h("B");a.1y()})},1Y:m(a){$(".G-1l",a.1O).3Q()}}})}3S.36&&36();$("#4G").r();$("#4P").r();$("#57").r();$("#58").r();$("35#5E 34 a").r();$("#3n").r({1j:"3B",D:"3F",1d:!0,X:{19:0.7},15:{12:!1}});$("#3T").B(m(){$.r([{l:"9/i/x/u/33.k",t:"w",n:{q:"9/i/o/u/33.k",D:"18"}},{l:"9/i/x/u/32.k",t:"w",n:{q:"9/i/o/u/32.k"}},{l:"9/i/x/u/31.k",n:{q:"9/i/o/u/31.k",D:"18"},t:"w"},{l:"9/i/x/u/30.k",n:{q:"9/i/o/u/30.k"},t:"w",O:"3V 3X 41 43 44 21 a 47-4j 4v 4y 4B."},{l:"9/i/x/u/2Y.k",n:{q:"9/i/o/u/2Y.k"},t:"w"},{l:"9/i/x/u/2X.k",n:{q:"9/i/o/u/2X.k",D:"18"},t:"w"},{l:"9/i/x/u/2V.k",n:{q:"9/i/o/u/2V.k"},t:"w"},{l:"9/i/x/u/2U.k",n:{q:"9/i/o/u/2U.k",1a:5A},t:"w",O:"2b 1g 3m 2c 3o:3p"},{l:"9/i/x/u/2T.k",n:{q:"9/i/o/u/2T.k"},t:"w"},{l:"9/i/x/u/2S.k",n:{q:"9/i/o/u/2S.k"},t:"w"},{l:"9/i/x/u/2R.k",n:{q:"9/i/o/u/2R.k",D:"18"},t:"w"},{l:"9/i/x/u/2P.k",n:{q:"9/i/o/u/2P.k"},t:"w"},{l:"9/i/x/u/2N.k",n:{q:"9/i/o/u/2N.k",D:"18"},t:"w"},{l:"9/i/x/u/2M.k",n:{q:"9/i/o/u/2M.k"},t:"w"},{l:"9/i/x/u/2L.k",n:{q:"9/i/o/u/2L.k"},t:"w"},{l:"9/i/x/u/2K.k",n:{q:"9/i/o/u/2K.k"},t:"w"}],{40:3,D:"42",1h:"1i",45:1.3,X:{19:0.4},1m:{4i:2J,1o:0.55,4A:2J,1q:0.55},o:{4C:0.6,4M:1}});11!1});$("#4T").B(m(){$.r([{l:"9/i/x/y-A-z-1A.k",n:{q:"9/i/o/y-A-z-1A.k"},t:"w",O:"2I 2H. 27\'2d 2F 2E 2D."},{l:"9/i/x/y-A-z-1w.k",n:{q:"9/i/o/y-A-z-1w.k"},t:"w",O:"2C 2A, 2z\'s 2w 2u. 2p 1e 2m."},{l:"9/i/x/y-A-z-1s.k",n:{q:"9/i/o/y-A-z-1s.k"},t:"w",O:"2l 2j, K 1g. 2i."},{l:"9/i/x/y-A-z-1u.k",n:{q:"9/i/o/y-A-z-1u.k"},t:"w"},{l:"9/i/x/y-A-z-1v.k",n:{q:"9/i/o/y-A-z-1v.k"},t:"w"},{l:"9/i/x/y-A-z-2g.k",n:{q:"9/i/o/y-A-z-2f.k"},t:"w"}],{D:"16-23",1h:"1i",X:{19:0.7,1t:!1},24:{25:!1},1m:{1o:0.55,1q:0.55}});11!1});$("#4F").r({1j:"1r",D:"16-1x"});$("#4H").B(m(){$.r([{l:"#4I",t:"4J",n:{1a:1z,1k:4Q}}],{D:"16-1x"});11!1});$("#4S").r({1j:"1r",X:{19:0.6},D:"1B",Z:1});$("#4W").r({1j:"1r",X:{19:0.6},D:"1B",Z:1});$("#50").r({1j:"1r",1d:!0,X:{19:0.6,1t:!1},15:{12:!1},24:{25:!1},D:"1B",Z:1});$("#51").r({1d:!0,15:{12:!1},D:"18"});$("#52").r({1d:!0,15:{12:!1},Z:1});$("#53").r();$("#5I").r({Z:1});$("#56").r({Z:1});$("#2G").B(m(){C b=$(\'<1C J="5f"><2e><i 5j="9/i/5o.5w">27\\\'s 5x 2c 5y.</2e><5z><p>r 5B 2G 5C 5D 21 1D 5F.</p></1C>\');$.r([{l:b,t:"I"}],{1d:!0,15:{12:!1},D:"1B",Z:1});11!1});$("#5G").r();$("#5H").r();$("#3c").r();$("#3d").r();$("#3e").r({14:!0});$("#3g").r({14:!0});$("#3h").r({14:!0});$("#3i").r({14:!0});$("#3j").r({14:!0});$("#3k").r({14:!0});$("#3l").B(m(){$.r([{l:"Y://1b.2h.10/1X?v=3r-E-3s"},{l:"Y://3t.10/3u"},{l:"Y://1b.3v.10/1X/3w"},{l:"Y://1b.3x.10/1X/3y/3z/"},{l:"Y://1b.3A.10/2k/3C-3D-3E-1W-3G"},{l:"Y://1b.3H.10/3I/3J/3K-3-1D-7-3L---3M-1--3N-3O-a-3P",n:{1a:1U,1k:1z}}],{14:!0,D:"18",X:{1t:!1},24:{25:!1},1m:{1o:0.55,1q:0.55}});11!1});$("#3R").B(m(){$.r([{l:"Y://2n.10/1R/9/2o.3U",n:{q:"9/i/o/F/1W.k",3W:{2q:"Y://2n.10/1R/9/2o.2q",3Y:"9/i/F/1W.k"},1a:1U,1k:3Z}},{l:"9/i/F/1.k",O:"2b 1g 2r 1D 2s 2t 1f 2v 12.",n:{q:"9/i/o/F/1.k",1Q:"2r"}},{l:"9/i/F/2.k",O:"2b 1g 2x 2c 1D 2s 2t 1f 2v 12.",n:{q:"9/i/o/F/2.k",1Q:"2x"}},{l:"Y://1b.2h.10/48/49?4a=1&4b=0&4c=0&4d=0&4e=0",n:{q:"9/i/o/F/4f.k",1Q:"4g",4h:"2k",1a:1U,1k:1z}},{l:"9/i/F/3.k",n:{q:"9/i/o/F/3.k"}},{l:"9/i/F/4.k",n:{q:"9/i/o/F/4.k"}},{l:"9/i/F/5.k",n:{q:"9/i/o/F/5.k"}},{l:"9/i/F/6.k",n:{q:"9/i/o/F/6.k"}},{l:"9/i/F/7.k",n:{q:"9/i/o/F/7.k"}},{l:"9/i/F/8.k",n:{q:"9/i/o/F/8.k"}}],{1h:"1i",D:"16-23",1m:{1o:0,1q:0}});11!1});$("#4k").B(m(){$.r([{l:"9/4l/4m.I",n:{1a:1z,1k:4n},t:"4o"}],{Z:1,D:"16-23"});11!1});C e=$(\'<a J="G G-1l 4p">3a</a>\'),g=!1,f=20;$("35#4q 34 a").r({D:"16-1x",1h:"1i",15:{q:!1},1m:{4r:4s,4t:0.6,4u:0.6,1o:0.6,1q:0.6},2y:{4w:4x},28:{1P:m(){C b=K;$("4z").H(e);e.21("B",m(){g?j():(b.1n.2B==b.1n.1N-1&&b.4D(0),g=!0,e.1Z("4E"),f=1L(m(){b.1K("1J")},1I))})},1H:m(){e.4K("B").1y().4L()},1G:m(){e.4N(K.n.2y.4O)},22:m(){26(f)},1V:m(b){C a=K;g&&(b.4R==K.1n.1N-1?j():f=1L(m(){a.1K("1J")},1I))},1T:m(){e.1y();26(f)},1S:m(){C b=K;e.38();g&&b.1n.2B!=b.1n.1N-1&&(f=1L(m(){b.1K("1J")},1I))}}});$("#4U").B(m(){C b;b=$("<p />",{I:"4V 1c() 4X 4Y 4Z.","J":"2O"});C a=$("<1p />",{I:"2Q","J":"G G-1l",1M:m(a){13==a.1F&&$(K).29("B")}});h(b.17(a),"59!")});$("#5a").B(m(){C b=$("<p />",{I:"5b 5c 1f 5d r?","J":"2O"}),a=$("<5e />",{t:"1Z",2W:"5g!"}),d=$("<1C />",{"J":"5i"}),c=$("<1p />",{I:"2Q","J":"G G-1l",B:m(){C b=a.2W();1c(b)},1M:m(a){13==a.1F&&$(K).29("B")}}),e=$("<1p />",{I:"5k","J":"G",B:m(){1c(20)}});h(b.17(a).17(d).17(c).17(e),"5l!")});$("#5m").B(m(){C b=$("<p />",{I:"5n 2Z 5p 1f 5q r"}),a=$("<1p />",{I:"2Z","J":"G G-1l",B:m(){1c(!0)},1M:m(a){13==a.1F&&$(K).29("B")}}),d=$("<1p />",{I:"5r","J":"G",B:m(){1c(!1)}});h(b.17(d).17(a),"5s 1f 5t?",m(){1c(!1)})});$("#5u").B(m(){C b=$("#5v");$.r([{l:"9/i/x/y-A-z-1A.k",n:{q:"9/i/o/y-A-z-1A.k"},t:"w",O:"2I 2H. 27\'2d 2F 2E 2D."},{l:"9/i/x/y-A-z-1w.k",n:{q:"9/i/o/y-A-z-1w.k"},t:"w",O:"2C 2A, 2z\'s 2w 2u. 2p 1e 2m."},{l:"9/i/x/y-A-z-1s.k",n:{q:"9/i/o/y-A-z-1s.k"},t:"w",O:"2l 2j, K 1g. 2i."},{l:"9/i/x/y-A-z-1u.k",n:{q:"9/i/o/y-A-z-1u.k"},t:"w"},{l:"9/i/x/y-A-z-1v.k",n:{q:"9/i/o/y-A-z-1v.k"},t:"w"},{l:"9/i/x/y-A-z-2g.k",n:{q:"9/i/o/y-A-z-2f.k"},t:"w"}],{1h:"1i",X:{19:0.7},28:{1P:m(){C a=Q W;b.H(a.V()+":"+a.P()+":"+a.T()+"."+a.R()+\' - N "1P" L<M />\').S(U)},2a:m(a,d){C c=Q W;b.H(c.V()+":"+c.P()+":"+c.T()+"."+c.R()+\' - N "2a" L 1e 1E \'+d+".<M />").S(U)},1Y:m(a,d){C c=Q W;b.H(c.V()+":"+c.P()+":"+c.T()+"."+c.R()+\' - N "1Y" L 1e 1E \'+d+".<M />").S(U)},1H:m(){C a=Q W;b.H(a.V()+":"+a.P()+":"+a.T()+"."+a.R()+\' - N "1H" L.<M /><p>-----------------------------------</p>\').S(U)},1T:m(){C a=Q W;b.H(a.V()+":"+a.P()+":"+a.T()+"."+a.R()+\' - N "1T" L.<M />\').S(U)},1S:m(){C a=Q W;b.H(a.V()+":"+a.P()+":"+a.T()+"."+a.R()+\' - N "1S" L.<M />\').S(U)},3b:m(a,d){C c=Q W;b.H(c.V()+":"+c.P()+":"+c.T()+"."+c.R()+\' - N "3b" L 1e 1E \'+d+".<M />").S(U)},1G:m(a,d){C c=Q W;b.H(c.V()+":"+c.P()+":"+c.T()+"."+c.R()+\' - N "1G" L 1e 1E \'+d+".<M />").S(U)},22:m(){C a=Q W;b.H(a.V()+":"+a.P()+":"+a.T()+"."+a.R()+\' - N "22" L.<M />\').S(U)},1V:m(){C a=Q W;b.H(a.V()+":"+a.P()+":"+a.T()+"."+a.R()+\' - N "1V" L.<M />\').S(U)}}});11!1})});',
		d=355,e="         assets         img  jpg URL function options thumbnails  thumbnail iLightBox  type caesarlima  image photos MS day test click var skin  sherlock_holmes btn append html class this fired br Event caption getMinutes new getMilliseconds scrollTop getSeconds 1E4 getHours Date overlay http minScale com return fullscreen  smartRecognition controls metro add dark opacity width www alert innerToolbar for you one path horizontal attr height primary styles vars nextOpacity button prevOpacity target 27845 blur 27780 278081 27771 white hide 720 27898 parade div the item keyCode onAfterLoad onHide 5E3 next moveTo setTimeout keyup total currentElement onOpen fullViewPort ilightbox onExitFullScreen onEnterFullScreen 1280 onAfterChange trailer watch onShow text null on onBeforeChange black keyboard esc clearTimeout It callback trigger onRender This to ll h2 27749_2 27749 youtube Checkmate lastly video And yourself iprodev MV5BMTM1NTMyMDE4OV5BMTFeQW1wNF5BbWU3MDEyNTI0OTU See webm fill screen when good enter that fit effects it yeah current Oh mind your blow DOM Caption First 75 631_1steampunksplash4 603_1beauty4 604_1beauty3 592_1r388_yb_banner dialogue_message 585_1DawnO_056casei OK 601_1beauty1 583_1testsnowwhite 625_1beautykaetsite 350_1r3__2007__caesarlima_seb8mag3 319_1caenewpg2 val 618_1marilia_splash 481_1cae_shadow Yes 599_1nero_splash_1 397_1natascha_wind 452_1npblonde 489_1zokvamp_beauty li ul prettyPrint effect show dialogue Slideshow onBeforeLoad video_3 video_html5 video_4 title video_5 video_6 video_7 video_8 video_9 video_gallery resized forceresize wiidth 300px clearfix _Z4Z Mxbo vimeo 55331511 hulu 424558 metacafe 9542534 man_of_steel_trailer dailymotion photo xp53r5_the avengers official mac 2_shortfilms gametrailers videos za4633 crysis wonders episode hell of town focus mixed_contents window inline_gallery mp4 Skins html5video can poster 544 startFrom even light be modified maxScale document per embed lNxhpNpnAkk autohide border egm showinfo showsearch mqdefault stretch icon nextOffsetX element google_maps ajax maps 420 iframe slideshow_button image_gallery_with_slideshow pageOffsetY 100 nextScale prevScale or switchSpeed 700 group body prevOffsetX basis normalOpacity goTo Stop inline_html_simple singleimage_1 inline_html_forced demo_inline_element inline off remove activeOpacity fadeIn loadedFadeSpeed singleimage_2 360 currentItem ajax_simple open_in_modal show_alert Custom ajax_forced functions are cool ajax_modal flash_simple flash_forced iframe_1 ready  iframe_3 singleimage_3 singleimage_4 Alert show_prompt How would describe input center Awesome unbind clear src Cancel Attention show_confirm Click smile if love No Do agree events_gallery pre_events gif time upgrade hr 300 supports elements created image_gallery fly video_1 video_2 iframe_2".split(" "),
		f=0,g={},f=function(b){return(62>b?"":f(parseInt(b/62)))+(35<(b%=62)?String.fromCharCode(b+29):b.toString(36))};if(!"".replace(/^/,String)){for(;d--;)g[f(d)]=e[d]||f(d);e=[function(b){return g[b]}];f=function(){return"\\w+"};d=1}for(;d--;)e[d]&&(c=c.replace(RegExp("\\b"+f(d)+"\\b","g"),e[d]));a(c);
		
		
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'ID']);
		_gaq.push(['_setDomainName', 'HOST']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

		window.___gcfg = {lang: "en"};
		(function() {
			var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
			po.src = "https://apis.google.com/js/plusone.js";
			var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
		})();
    </script>


<script>
$(document).ready(function() {
  var $container = $('.graphposts');
  $('.pagination ul li:not(:last)').remove();

	$container.infinitescroll({

    navSelector  : ".pagination",            
                   // selector for the paged navigation (it will be hidden)
    nextSelector : ".pagination ul li a",    
                   // selector for the NEXT link (to page 2)
    itemSelector : ".box",          
                   // selector for all items you'll retrieve
    loading: {
        finished: undefined,
        finishedMsg: "<em>Congratulations</em>",
        img: "/images/loader.gif",
        msg: null,
        msgText: "<em>Loading the next set of posts...</em>",
        selector: null,
        speed: 'fast',
        start: undefined
    }
  },
  // trigger Masonry as a callback
  function( newElements ) {
    var $newElems = $( newElements );
    $container.masonry( 'appended', $newElems );
    	$container.imagesLoaded( function(){
  			$container.masonry({
    		itemSelector : '.box'
  		});
  			function Populate(){
    vals = $('input[type="checkbox"]:checked').map(function() {
        return this.value;
    }).get().join(',');
    console.log(vals);
    $('#removeposts').val(vals);
	}

	$('input[type="checkbox"]').on('change', function() {
    Populate()
    $('#buttonremove').show();

    if(!$('#removeposts').val()){
	$('#buttonremove').hide();
	}
	}).change();
	});
  }
);


});

</script>

<script>
$('#inputTextarea').wysihtml5({
	"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
	"emphasis": true, //Italics, bold, etc. Default true
	"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
	"html": false, //Button which allows you to edit the generated HTML. Default false
	"link": true, //Button to insert a link. Default true
	"image": false, //Button to insert an image. Default true,
	"color": false //Button to change color of font  
});
</script>

<script>
	$(document).ready(function(){
			var rootLimit = 8;
			$('#edit-menu > ul').nestedSortable({
			handle:'a',
			items: 'li',
			listType:'ul',
			maxLevels:'3',
			toleranceElement: '> a',
			update:function(event, ui){
				list = $('ul.sortable').nestedSortable('toArray');
				var page_id = ui.item.find('> a').attr('data-page-id');
				console.log(list);
					index = ui.item.index();
					for(var i=index, len=list.length; i<len; i++) {
						if (list[i].item_id === page_id) {
						parent = list[i].parent_id;
						break;
						}
					}
					console.log(index);
					console.log(parent);
				
				$.post('/page/updatemenu/' + page_id, { index : index , parent : parent },
				function(data)
				{
					
				});
			}
		});
	});
 </script>

 <script type="text/javascript">
$(document).ready(function(){

@section('scripts')
@show

@yield('scriptsremove')

@yield('scriptsdocuments')

@yield('scriptstags')

});
</script>

<script>
$('select[name=select-model]').change(function(){
	$('form[name=form-search]').submit();
	});
</script>

<script>
$('select[name=select-type]').change(function(){
	$('form[name=form-search]').submit();
	});
</script>

<script>
$('select[name=select-tag]').change(function(){
	$('form[name=form-search]').submit();
	});
</script>

<script type="text/javascript"> 
	 $(".chzn-select").chosen();
</script>


<script>

</script>

<script src="http://connect.soundcloud.com/sdk.js"></script>
			
			<script>
			SC.initialize({
			  client_id: '4dad0bbf95a4e0ab59b556e79fe2ce55'
			});
			</script>


<script>
$(document).ready(function() {	
$("#youtube").select2({
    placeholder: "Search for a track",
    minimumInputLength: 3,
    ajax: {
        url: "http://gdata.youtube.com/feeds/api/videos?format=5&max-results=20&v=2&alt=jsonc",
        dataType: 'jsonp',
        quietMillis: 100,
        data: function (term, page) { // page is the one-based page number tracked by Select2
            return {
                q: term, //search term
                page_limit: 10, // page size
                page: page, // page number
            };
        },
        results: function (data,page) {
            var more = (page * 10) < data.total; // whether or not there are more results available
 			console.log(data.data.items);
            // notice we return the value of more so Select2 knows if more results can be loaded
            return {results: data.data.items, more: more};
        }
    },
    formatResult: youtubeFormatResult, // omitted for brevity, see the source of this page
    formatSelection: youtubeFormatSelection, // omitted for brevity, see the source of this page
    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
});
});
</script>

<script>

    function youtubeFormatResult(data) {
        var markup = "<table class='movie-result'><tr>";
        if (data.artwork_url !== null){
        markup += "<td class='soundcloud-image'><img src='" + data.thumbnail.hqDefault + "' width='100' height='100'/></td>";
    	}
        markup += "<td class='movie-info'><div class='movie-title'>" + data.title + "</div>";
        markup += "</td></tr></table>"
        return markup;
    }

    function youtubeFormatSelection(data) {
        
    	$('#postsoundcloud').empty();
        $('.preview').empty();
        $('#soundcloud').val('');
        $('.soundcloud-hidden').val('');
        $('.soundcloud-hidden').attr('value', data.permalink_url);
        $('#title').attr('value', data.title);
        $('.youtube-hidden').attr('value', data.id);
        $('#art_urlyoutube').attr('value', data.thumbnail.hqDefault);
        var image = "<div class='slider-img ch-img-1 soundimgslider' style='background-image: url(" + data.thumbnail.hqDefault +");'></div>"
        $('.preview').append(image);
        $('#postsoundcloud').append("<iframe id='player' src='http://www.youtube.com/embed/" + data.id + "?rel=0&wmode=Opaque&enablejsapi=1' frameborder='0' width='100%'' height='300'></iframe>");
        return data.title;
    }

</script>

<script>
$(document).ready(function() {
$("#soundcloud").select2({
    placeholder: "Search for a track",
    minimumInputLength: 3,
    ajax: {
        url: "https://api.soundcloud.com/tracks?client_id=4dad0bbf95a4e0ab59b556e79fe2ce55",
        dataType: 'json',
        quietMillis: 100,
        data: function (term, page) { // page is the one-based page number tracked by Select2
            return {
            	types:["bpm"],
                q: term, //search term
                page_limit: 10, // page size
                page: page, // page number
            };
        },
        results: function (data, page) {
            var more = (page * 10) < data.total; // whether or not there are more results available
 			console.log(data);
            // notice we return the value of more so Select2 knows if more results can be loaded
            return {results: data, more: more};
        }
    },
    formatResult: movieFormatResult, // omitted for brevity, see the source of this page
    formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
});
});
</script>

<script>

    function movieFormatResult(data) {
        var markup = "<table class='movie-result'><tr>";
        if (data.artwork_url !== null){
        markup += "<td class='soundcloud-image'><img src='" + data.artwork_url + "'/></td>";
    	}
        markup += "<td class='movie-info'><div class='movie-title'>" + data.title + "</div>";
        markup += "</td></tr></table>"
        return markup;
    }

    function movieFormatSelection(data) {
        $('.preview').empty();
        $('#postsoundcloud').empty();
        $('.soundcloud-hidden').attr('value', data.permalink_url);
        $('.soundcloudid-hidden').attr('value', data.id);
        $('#title').attr('value', data.title);
        $('.genre').attr('value', data.genre);
        $('.genre').change();
        var script   = document.createElement("script");
		script.type  = "text/javascript";    // use this for linked script
		script.text  = "SC.oEmbed('" + data.permalink_url + "', {color: 'c6e2cc'},  document.getElementById('postsoundcloud'));"               // use this for inline script
		$('#postsoundcloud').append(script);
        $('.genre-hidden').attr('value', data.genre);
        $('.genre-hidden').change();
        var str=data.artwork_url;
		var n=str.replace("large","t500x500");
        $('#art_urlsoundcloud').attr('value', n);
        var image = "<div class='slider-img ch-img-1 soundimgslider' style='background-image: url(" + data.artwork_url +");'></div>"
        $('.preview').append(image);
        return data.title;
    }

</script>

<script>

	$("#suggestions").hide();
	
	$('#searchDatauser').keyup(function() {
	var url =(location.protocol + "//" + location.hostname + 
      (location.port && ":" + location.port));
	console.log(url);
 	var searchVal = $(this).val();
 	$("#suggestions").show();
 	if(searchVal !== '') {
 
            $.get(url + '/search?searchData='+searchVal, function(returnData) {
                /* If the returnData is empty then display message to user
                 * else our returned data results in the table.  */
                if (!returnData) {
                    $('.music-posts').html('<p style="padding:5px;">Search term entered does not return any data.</p>');
                } 
                else 
                {
                	
					console.log(returnData);
                	$('#suggestions div').each(function(i)
					{
						$(this).css("display", "none");
   						
					});

                 	for (var i = 0; i < returnData.length; i++) {
                 	
    				if(returnData[i].id !== undefined)
    				{
    					console.log(returnData[i].first_name);
                 	$searchuser = "<li id='searchresultuser span3'><div class='span1 searchimg'><img src='" + returnData[i].image +"' width='30'></div><div class='span2'><h6><a href='http://thevoltagecommunity.com/user/visitaccount/"+ returnData[i].id +"'>"+ returnData[i].first_name + " "+returnData[i].last_name +"</a></h6></div></li>";

                 	$("#suggestions").append($searchuser);
                 	}

					}  
    				
                }
            });
        } else {
            $('#suggestions').empty();
            $("#suggestions").hide();
			
        }
 
    });
</script>





</body>
</html>