@extends('instance.layout')

@section('instanceContent')

<div class="span9 offset2">
<h2>Choose type of post </h2>
</div>

<div class="row 12">
	<div class="span3 thumbnail-gallery offset3">
		<ul class="thumbnails">
			<li class="span3">
				<div class="thumbnail thumbnail-businesscards">
					<img src="/images/music.png"  width="400" height="300" alt="">
					<div class="btn-centered">
						<a class="btn btn-inverse" href="{{ URL::action('PostController@createMusic') }}?type=music">Select</a>
					</div>
				</div>
			</li>
		</ul>
	</div>

  	<div class="span3 thumbnail-gallery">
		<ul class="thumbnails">
			<li class="span3">
				<div class="thumbnail thumbnail-businesscards">
					<img src="http://placehold.it/400x300&text=Graph" alt="">
					<div class="btn-centered">
						<a class="btn btn-inverse" href="{{ URL::action('PostController@createGraph') }}?type=graph">Select</a>
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>

@stop