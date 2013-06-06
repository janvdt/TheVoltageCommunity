@extends('instance.layout')

@section('instanceContent')
		<div class="span12 welcome">
			<div class="welcomecontent span6">
				<p class="welcometitle">YOUR MIX OF MUSIC</p>
				<p>The Voltage Community is a place to share what fuels your creativity, and discover what inspires others.
					Built by people who love music, for designers, this is your one-stop shop for creative inspiration.
				</p>
			</div>
			<div class="span5 getstarted">
				<div class="pull-right">
					<a href="{{ URL::route('login') }}" class="btn btn-large btn-inverse">Get started</a>
				</div>
			</div>
		</div>


<div class ="span12 tracks-overview-home">
	<h2>Music</h2>
	<div class="row homemusic">
		<ul class="ch-grid nav nav-pills music-posts">
			@foreach ($musicposts as $musicpost)
				
					<li class= "musicpost span3">
						<a href ="{{ URL::action('PostController@showMusic', array($musicpost->id)) }}">
						@if($musicpost->image_id != 0)
							<div class="ch-item ch-img-1" style="background-image: url(/{{ $musicpost->image->getSize('thumb')->getPathname() }});">
						@else
						@if($musicpost->soundcloud_art != NULL)
							<div class="ch-item ch-img-1 soundcloudimg" style="background-image: url({{$musicpost->soundcloud_art}});">
						@else
							<div class="ch-item ch-img-1 youtubeimg" style="background-image: url({{$musicpost->youtube_art}});">
						@endif
						@endif

						<div class="ch-info">
							<?php 
								$string = $musicpost->title;
								$maxLength = 40;

								if (strlen($string) > $maxLength) {
									$stringCut = substr($string, 0, $maxLength);
									$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
								}

								echo "<h3>$string</h3>"
							?>
							
								<a class="link" href=""></a>
							
            			</div>
        			</div>
        			</a>
        			<div class="row accountpost">
        				@if($musicpost->createdBy()->accountUser()->image_id != 0 or $musicpost->createdBy()->accountUser()->	facebookpic == NULL )
							<img src="{{ url($musicpost->createdBy()->accountUser()->getImagePathname()) }}" width="25" alt="">
						@else
							<img src="{{ url($musicpost->createdBy()->accountUser()->facebookpic) }}" width="25" alt="">
						@endif
						{{$musicpost->createdBy()->first_name}} {{$musicpost->createdBy()->last_name}}
					</div>
    				</li>
			@endforeach
		</ul>
	
		<div class="shelf">
			<div class="bookend_left"></div>
			<div class="bookend_right"></div>
			<div class="reflection"></div>
		</div>
	</div>
</div>

<div class ="span12 tracks-overview-home">
	<h2>Graphics</h2>
	<div class="row">
		<ul class="ch-grid nav nav-pills music-posts">
			@foreach ($graphposts as $graphpost)
				
					<li class= "musicpost span3">
						<a href ="{{ URL::action('PostController@showGraph', array($graphpost->id)) }}">
						@if($graphpost->image_id != 0)
							<div class="ch-item ch-img-1" style="background-image: url(/{{ $graphpost->image->getSize('thumb')->getPathname() }});">
						@endif

						<div class="ch-info">
							<?php 
								$string = $graphpost->title;
								$maxLength = 40;

								if (strlen($string) > $maxLength) {
									$stringCut = substr($string, 0, $maxLength);
									$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
								}

								echo "<h3>$string</h3>"
							?>
							
								<a class="link" href=""></a>
							
            			</div>
        			</div>
        			</a>
        			<div class="row accountpost">
        				@if($graphpost->createdBy()->accountUser()->image_id != 0 or $graphpost->createdBy()->accountUser()->	facebookpic == NULL )
							<img src="{{ url($graphpost->createdBy()->accountUser()->getImagePathname()) }}" width="25" alt="">
						@else
							<img src="{{ url($graphpost->createdBy()->accountUser()->facebookpic) }}" width="25" alt="">
						@endif
						{{$graphpost->createdBy()->first_name}} {{$graphpost->createdBy()->last_name}}
					</div>
    				</li>
			@endforeach
		</ul>
	
		<div class="shelf span12">
			<div class="bookend_left"></div>
			<div class="bookend_right"></div>
			<div class="reflection"></div>
		</div>
	</div>
</div>




@stop
