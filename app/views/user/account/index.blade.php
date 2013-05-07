@extends('instance.layout')

@section('instanceContent')
<div class="span12">
	<h4>Welcome {{$user->first_name}} {{$user->last_name}} </h4>
</div>
<div class="row">
	<div class="span12">
		<div class="span4">
			<a href="{{ URL::action('AccountController@edit', array($user->accountUser()->id)) }}" class="btn btn-primary">Edit Account</a><br />
			<img src="{{ url($user->accountUser()->getImagePathname()) }}" alt="">
		</div>

		<div class="span4">
			<h4>Biografie</h4>
			<p class="span4">{{$user->accountUser()->biography}}</p>
		</div>
		<div class="span3">
			<h4>Social</h4>
			<div class="pull-left">
				<h5>Following</h5>
				<p>{{count($following)}}</p>
				@foreach($following as $follow)
				<img class="img-rounded" src="{{ url($follow->account->getImagePathname()) }}" alt="" width="25">
				@endforeach
			</div>

			<div class="pull-right">
				<h5>Followers</h5>
				<p>{{count($followers)}}</p>
				@foreach($followers as $follower)
					<img class="img-rounded" src="{{ url($follower->accountfollower->getImagePathname()) }}" alt="" width="25">
				@endforeach
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div class="span4">
			<h4>Your Music Posts</h4>
			<ul>
				@foreach($musicposts as $musicpost)
					<li class="span3"><a href="{{ URL::action('PostController@showMusic', array($musicpost->id)) }}">{{$musicpost->title}}</a> <a href="" data-toggle="modal" class="btn btn-danger pull-right">Delete</a></li>
				@endforeach
			</ul>
		</div>

		<div class="span4">
			<h4>Your Graph Posts</h4>
			<ul>
				@foreach($graphposts as $graphpost)
					<li class="span3"><a href="">{{$graphpost->title}}</a> <a href="" data-toggle="modal" class="btn btn-danger pull-right">Delete</a></li>
				@endforeach
			</ul>
		</div>
	</div>
</div>


@stop