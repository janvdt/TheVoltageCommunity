@extends('instance.layout')

@section('instanceContent')

<h2>Look who's winning</h2>
<ul class="nav">
@foreach($totalscores as $totalscore)
<li>
	<div class="span12 score">
		<div class="span2">
			<p class="totalscore">{{$totalscore->value}}</p>
		</div>
		<div class="span2">
			<a href="{{ URL::action('UserController@visitAccount',array($totalscore->account->user->id)) }}">
				<img class="img-polaroid" src="{{ url($totalscore->account->getImagePathname()) }}" alt="" width="75px">
			</a>
		</div>

		<div class="span3">
			<p class="email">{{$totalscore->account->user->email}}</p>
		</div>
	<img class="levelimg" src="/images/{{$totalscore->account->levels->first()->image}}" width="50">
</div>
</li>
@endforeach


@stop