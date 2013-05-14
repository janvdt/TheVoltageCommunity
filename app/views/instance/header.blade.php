<div class="row site-header">
	<div class="span3 logo">
		<a href="{{{ URL::to('/') }}}"><img class="" src="/images/logovoltage.png" alt=""></a>
	</div>

	
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
	
