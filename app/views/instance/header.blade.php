<div class="row site-header">
	<div class="span3 logo">
		<a href="{{{ URL::to('/') }}}"><img class="" src="/images/logovoltage.png" alt=""></a>
	</div>

	@if (Auth::check())
	<ul class="nav span6">
		
			<li class="dropdown pull-right">
				<a id="choose-instance" href="" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i>
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
	@endif
	@if(Auth::user())
	<ul class="nav span1 pull-right">
		
			<li class="dropdown pull-right">
				<a id="choose-instance" href="" role="button" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-important">{{count($notcount)}}</span><b class="caret"></b></a>

				
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
					@if (Auth::check())
					<li class="span2"><a href="{{ URL::to('logout')}}">Logout</a></li>
					@else
						<li class="span2"><a href="{{ URL::route('login') }}">Login</a></li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>

@section('scripts')


@stop
	
