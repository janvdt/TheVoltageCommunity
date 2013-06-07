<div class="row">
	<div class="span4">
		<img src="/images/logofooter.png" width="300">
	</div>
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
						<li><a href="{{ URL::action('TurntableController@index') }}?scratch=1">DIY</a></li>
						<li id="graph"><a href="{{ URL::action('GraphController@index') }}">Graphics</a></li>
						<li id="graph"><a href="{{ URL::action('AccountController@showscores') }}">Scores</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>




	
