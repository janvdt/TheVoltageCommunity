@extends('instance.layout')

@section('instanceContent')

<h2>Look who's winning</h2>
<img class="crown" src="/images/crown.png" width="150">
<ul class="nav">
@foreach($totalscores as $totalscore)
<li>
	<div class="span12 score">
		<div class="span1">
			<p class="totalscore">{{$totalscore->value}}</p>
		</div>
		<div class="span1">
			<a href="{{ URL::action('UserController@visitAccount',array($totalscore->account->user->id)) }}">
				@if($totalscore->account->user->identifier != 0)
				<img class="img-polaroid imgscore" src="{{ url($totalscore->account->facebookpic) }}" alt="" width="75px">
				@else
				<img class="img-polaroid imgscore" src="{{ url($totalscore->account->getImagePathname()) }}" alt="" width="75px">
				@endif
			</a>
		</div>

		<div class="span4">
			<p class="email">{{$totalscore->account->user->first_name}} {{$totalscore->account->user->last_name}}</p>
		</div>
		<div class="span3">
			<img class="levelimg" src="/images/{{$totalscore->account->levels->first()->image}}" width="50">
		</div>
	</div>
</li>
@endforeach


@stop