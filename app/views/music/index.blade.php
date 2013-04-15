@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<h2>Music</h2>
	<div class="row">
		<ul class="nav nav-pills music-posts">
			@foreach ($musicposts as $musicpost)
				<li class="span3 musicpost" id="{{$musicpost->id}}">
					<div class="thumbnails-home">
						<a href ="{{ URL::action('PostController@showMusic', array($musicpost->id)) }}">
						<img class="avatar img-polaroid" src="/{{ $musicpost->image->getSize('thumb')->getPathname() }}" alt="">
					</a>
						Posted by : <a href="">{{$musicpost->createdBy()->first_name}} {{$musicpost->createdBy()->last_name}}</a>
					</div>
					<div class="shelf shelfmusicpost">
			<div class="bookend_left"></div>
			<div class="bookend_right"></div>
			<div class="reflection"></div>
		</div>
				</li>
			@endforeach
		</ul>
	
		
	</div>
</div>
<div class="row">
	<div class="span12 loader">
	</div>
</div>
<div class="row">
		<div class="span12">
			<div class="pagination pagination-centered">
				{{ $musicposts->links() }}
			</div>
		</div>
	</div>


@stop