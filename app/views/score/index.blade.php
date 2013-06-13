@extends('instance.layout')

@section('instanceContent')

<h2>Look who's winning</h2>
<ul class="nav">
@foreach($totalscores as $totalscore)
<li>
	<div class="span12 score">
		<div class="span1">
			<p class="totalscore">{{$totalscore->value}}</p>
		</div>
		<div class="span1">
			<a href="{{ URL::action('UserController@visitAccount',array($totalscore->account->user->id)) }}">
				<img class="img-polaroid imgscore" src="{{ url($totalscore->account->getImagePathname()) }}" alt="" width="75px">
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