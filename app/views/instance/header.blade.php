<div class="row">
<div class="span12 navigation">
	<div class="container menu clearfix pull-right">
		<div class="navbar navbar_">
			<div class="container">
				 <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse_">Menu <span class="icon-bar"></span> </a>
				<div class="nav-collapse nav-collapse_  collapse">
	                <ul class="nav sf-menu">
						<li id="music"><a href="{{ URL::action('MusicController@index') }}">Music</a></li>
						<li><a id="graph" href="{{ URL::action('GraphController@index') }}">Graph</a></li>
						<li><a id="diy" href="{{ URL::action('TurntableController@index') }}?scratch=1">DIY</a></li>
						<li><a id="about" href="{{ URL::action('PlaylistController@showAll') }}">Playlists</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>




	
