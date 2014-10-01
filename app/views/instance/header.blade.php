<div class="row">
	<a href="{{URL::to("/")}}">
	<div class="span4 logosite">
		
			
		
	</div>
	</a>
<div class=" offset2 span6 navigation">
	<div class="container menu clearfix pull-right">
		<div class="navbar navbar_">
			<div class="container">
				 <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse_">Menu <span class="icon-bar"></span> </a>
				<div class="nav-collapse nav-collapse_  collapse menu">
	                <ul class="nav sf-menu">
	                	<li id="home"><a href="{{URL::to("/")}}">Home</a></li>
						<li id="music"><a href="{{ URL::action('MusicController@index') }}">Music</a></li>
						<li id="playlist"><a href="{{ URL::action('PlaylistController@showAll') }}">Playlists</a></li>
						<li id="diy"><a href="{{ URL::action('TurntableController@index') }}?scratch=1">DIY</a></li>
						<li id="graph"><a href="{{ URL::action('GraphController@index') }}">Graphics</a></li>
						@if(Auth::user())
						<li id="graph"><a href="{{ URL::action('AccountController@showscores') }}">Scores</a></li>
						<li id="feedback"><a href="{{ URL::action('FeedbackController@index') }}">Feedback</a></li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>




	
