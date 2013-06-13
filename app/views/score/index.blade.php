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
			<p class="email">{{$totalscore->account->user->email}}</p>
		</div>
		<div class="span1 pull-left">
			<h3>Level</h3>
		</div>
		<div class="span3">
			<img class="levelimg" src="/images/{{$totalscore->account->levels->first()->image}}" width="50">
			@if($totalscore->account->levels->first()->id == 2)
			<img class="levelimg" src="/images/{{$totalscore->account->levels->first()->image}}" width="50">
			@endif
			@if($totalscore->account->levels->first()->id == 3)
			<img class="levelimg" src="/images/{{$totalscore->account->levels->first()->image}}" width="50">
			@endif
			@if($totalscore->account->levels->first()->id == 4)
			<img class="levelimg" src="/images/{{$totalscore->account->levels->first()->image}}" width="50">
			@endif
			@if($totalscore->account->levels->first()->id == 5)
			<img class="levelimg" src="/images/{{$totalscore->account->levels->first()->image}}" width="50">
			@endif

</div>
</li>
@endforeach


@stop