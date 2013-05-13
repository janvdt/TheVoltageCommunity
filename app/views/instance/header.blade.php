<div class="row site-header">
	<div class="span3 logo">
		<a href="{{{ URL::to('/') }}}"><img class="" src="/images/logovoltage.png" alt=""></a>
	</div>

	@if (Auth::check() or Session::has('hybridAuth'))
	<ul class="nav span6">
		
			<li class="dropdown pull-right">
				<a id="choose-instance" href="" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i>
				@if(Auth::user())
				 Welcome {{Auth::user()->first_name}} {{Auth::user()->last_name}}
				@else
				Welcome {{$facebookuser->first_name}} {{$facebookuser->last_name}}
				@endif
				<b class="caret"></b></a>

				<ul class="dropdown-menu" role="menu" aria-labelledby="choose-instance">
					<li>
						@if(Auth::user())
						<a href="{{ URL::action('UserController@showAccount',array(Auth::user()->id)) }}"><i class="icon-eye-open"> View Account</i></a>
						@else
						<a href="{{ URL::action('UserController@showAccount',array($facebookuser->id)) }}"><i class="icon-eye-open"> View Account</i></a>
						@endif

					</li>
					<li><a href=""><i class="icon-key"> Change password</i></a></li>
					<li><a href="{{ URL::action('PostController@create') }}"><i class="icon-plus"> Create post</i></a></li>
				</ul>
			</li>
		
	</ul>
	@endif
	@if(Auth::user() or Session::has('hybridAuth'))
	<ul class="nav span1 pull-right">
		
			<li class="dropdown pull-right">
				<a id="choose-instance" href="" role="button" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-important">{{count($notcount)}}</span><b class="caret"></b></a>

				<ul class="dropdown-menu notifications span4" role="menu">
					@foreach($notifications as $notification)
						@if(Auth::user() and $notification->post->created_by == Auth::user()->id or $notification->post->created_by == $facebookuser->id)
							@if($notification->activity == FALSE)
							@if($notification->viewed == FALSE)
								<li class="notificationsitem span3">
									<div class="alert alert-success">
									<a class="" href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
  									 {{$notification->user->first_name}} {{$notification->body}}
  									 @if($notification->post->soundcloud_art != NULL)
											<img class="img-rounded pull-right" src="{{ url($notification->post->soundcloud_art) }}" alt="" width="25">
										@else
											<img class="img-rounded pull-right" src="{{ url($notification->post->youtube_art) }}" alt="" width="25">
										@endif
									</a>
									</div>
								</li>
							@else
								<li class="notificationsitem span3">
									<div class="alert">
									<a class="" href="{{URL::action('PostController@showMusic',array($notification->post_id)) }}">
  									 {{$notification->user->first_name}} {{$notification->body}}
  									 @if($notification->post->soundcloud_art != NULL)
											<img class="img-rounded pull-right" src="{{ url($notification->post->soundcloud_art) }}" alt="" width="25">
										@else
											<img class="img-rounded pull-right" src="{{ url($notification->post->youtube_art) }}" alt="" width="25">
										@endif
									</a>
									</div>
									
									
								</li>
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
	<div class="span2 pull-right">
		<a href="{{ URL::action('HomeController@showActivity') }}"><i class="icon-bullhorn"> Activity log</i></a>
	</div>
	@endif
</div>

<div id="top-navbar" class="navbar navbar-static-top navbar-inverse span12">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li class="span2 offset2"><a href="{{ URL::action('MusicController@index') }}">Music</a></li>
					<li class="span2"><a href="{{ URL::action('GraphController@index') }}">Graph</a></li>
					<li class="span3"><a href="">Do it yourself</a></li>
				</ul>

				<ul class="nav">
					@if (Auth::check() or Session::has('hybridAuth'))
					<li class="span2"><a href="{{ URL::to('logout')}}">Logout</a></li>
					@else
						@if (!Session::has('hybridAuth'))
							<li class="span2"><a href="{{ URL::route('login') }}">Login</a></li>
						@endif
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>

@section('scripts')
	

@stop
	
