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
		@if(Auth::user())
		<div class="span3 socialbutton">
			<h4>Follow!</h4>
			@if($user->accountUser()->canFollow(Auth::user()->accountUser()->id,$user->accountUser()->id))
			<a class="btn btn-primary" id="follow"><i class="icon-star"> Follow !</i></a>
			@else
			<a class="btn btn-danger" id="unfollow"><i class="icon-star-empty"> Unfollow !</i></a>
			@endif
		</div>
		@endif
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

@section('scripts')
	@parent

	 $("#follow").click(function(){ 

	$.post('/account/follow/' + {{$user->accountUser()->id}},
	function(data)
	{
		$("#follow").hide();
		var button = "<a class='btn btn-danger' id='unfollow'><i class='icon-star-empty'></i></a>";
		$(".socialbutton").append(button);
	});
});

	 $("#unfollow").click(function(){ 

	$.post('/account/unfollow/' + {{$user->accountUser()->id}},
	function(data)
	{
		$("#unfollow").hide();
		var button = "<a class='btn btn-primary' id='follow'><i class='icon-star'></i></a>";
		$(".socialbutton").append(button);
	});
});

@stop