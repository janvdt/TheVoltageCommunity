@extends('instance.layout')

@section('instanceContent')


<div class ="span12 artist-menu">

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
					<img class="avatar img-polaroid" src="/{{ $post->image->getSize('medium')->getPathname() }}" alt="">
					<div class="carousel-caption offset4">
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
	<div class="row">
		<ul class="nav nav-pills">
			@foreach ($musicposts as $musicpost)
				<li class="span3">
					<div class="thumbnails-home">
						<a href="{{ URL::action('PostController@showMusic', array($musicpost->id)) }}">
							<img class="avatar img-polaroid" src="/{{ $musicpost->image->getSize('thumb')->getPathname() }}" alt="">
						</a>
						Posted by : <a href="">{{$musicpost->createdBy()->first_name}} {{$musicpost->createdBy()->last_name}}</a>
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

<div class ="span12 tracks-overview-home">
	<h2>Graphics</h2>
	<div class="row">
		<ul class="nav nav-pills">
			@foreach ($graphposts as $graphpost)
				<li class="span3">
					<div class="thumbnails-home">
						<a href="{{ URL::action('PostController@showGraph', array($graphpost->id)) }}">
							<img class="avatar img-polaroid" src="/{{ $graphpost->image->getSize('thumb')->getPathname() }}" alt="">
						</a>
						Posted by :<a href="">{{$graphpost->createdBy()->first_name}} {{$graphpost->createdBy()->last_name}}</a>
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
