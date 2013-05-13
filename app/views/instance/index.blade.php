@extends('instance.layout')

@section('instanceContent')


<div class ="span12 artist-menu">
	<?php  
	$facebooklogin = Cache::get('hybridAuth');

	print_r($facebooklogin);

	?>
	
	<div id="myCarousel" class="carousel slide">

		<div class="carousel-inner">
			<?php $i = 0;?>
			@foreach($posts as $post)
				<?php $i++;?>
				@if($i == 1)
				<div class="item active">
				@else
				<div class="item">
				@endif
					@if($post->image_id != 0)
        			<div class="slider-img ch-img-1 dbimg" style="background-image: url(/{{ $post->image->getSize('thumb')->getPathname() }});">
        			@else
        			@if($post->soundcloud_art != NULL)
        			<div class="slider-img ch-img-1 soundimgslider" style="background-image: url({{$post->soundcloud_art}});">
        			@else
        			<div class="slider-img ch-img-1 youtubeimgslider" style="background-image: url({{$post->youtube_art}});">
        			@endif
        			@endif
        			</div>
					<div class="carousel-caption offset3">
						@if($post->type == 'music')
						<a class="btn btn-large pull-right" href="{{ URL::action('PostController@showMusic', array($post->id)) }}"><i class="icon-eye-open"></i> View</a>
						@elseif($post->type == 'graph')
						<a class="btn btn-large pull-right" href="{{ URL::action('PostController@showGraph', array($post->id)) }}"><i class="icon-eye-open"></i> View</a>
						@endif
						<h3>{{$post->title}}</h3>
						<?php $string = $post->body;
							$maxLength = 300;

						if (strlen($string) > $maxLength) {
    					$stringCut = substr($string, 0, $maxLength);
    					$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
						}

						echo "<p>$string...</p>"
						?>
						@if($post->soundcloud != NULL)
						<div class="soundcloud">
						
						</div>
						@endif
					</div>
				</div>
			@endforeach
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
	</div>
</div>

<div class ="span12 tracks-overview-home">
	<h2>Music</h2>
	<div class="row span12">
		<ul class="ch-grid nav nav-pills music-posts">
			@foreach ($musicposts as $musicpost)
				<a href ="{{ URL::action('PostController@showMusic', array($musicpost->id)) }}">
					<li class= "musicpost">
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
							<p><a href="{{ URL::action('UserController@visitAccount',array($musicpost->createdBy()->id)) }}">{{$musicpost->createdBy()->first_name}} {{$musicpost->createdBy()->last_name}}</a></p>
            			</div>
        			</div>
    				</li>
    			</a>
			@endforeach
		</ul>
	
		<div class="shelf span12">
			<div class="bookend_left"></div>
			<div class="bookend_right"></div>
			<div class="reflection"></div>
		</div>
	</div>
</div>

<div class ="span12 tracks-overview-home">
	<h2>Graphics</h2>
	<div class="row span12">
		<ul class="ch-grid nav nav-pills music-posts">
			@foreach ($graphposts as $graphpost)
				<a href ="{{ URL::action('PostController@showMusic', array($graphpost->id)) }}">
				<li class= "musicpost">
					@if($graphpost->image_id != 0)
					<div class="ch-item ch-img-1" style="background-image: url(/{{ $graphpost->image->getSize('thumb')->getPathname() }});">
					@else
					<div class="ch-item ch-img-1" style="background-image: url({{$graphpost->soundcloud_art}});">
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
							<p><a href="">{{$graphpost->createdBy()->first_name}} {{$graphpost->createdBy()->last_name}}</a></p>
						</div>
        			</div>
    			</li>
    			</a>
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
