@extends('instance.layout')

@section('instanceContent')
<div class="row">
	<div class="span12">
		<div class="span4">
			<img src="{{ url($user->accountUser()->getImagePathname()) }}" alt="">
		</div>

		<div class="span4">
			<h4>Biografie</h4>
			<p class="span4">{{$user->accountUser()->biography}}</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div class="span4">
			<h4>Music Posts</h4>
			<ul>
				@foreach($musicposts as $musicpost)
					<li class="span3">
						<a href="{{ URL::action('PostController@showMusic', array($musicpost->id)) }}">{{$musicpost->title}}</a>
					</li>
				@endforeach
			</ul>
		</div>

		<div class="span4">
			<h4>Graph Posts</h4>
			<ul>
				@foreach($graphposts as $graphpost)
					<li class="span3">
						<a href="">{{$graphpost->title}}</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@stop