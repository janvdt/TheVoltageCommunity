@extends('instance.layout')

@section('instanceContent')

<h2>Look who's winning</h2>
<ul class="nav">
@foreach($totalscores as $totalscore)
<li>
	<div class="span8">
	{{$totalscore->value}}
	{{$totalscore->account->user->email}}
	<img src="/images/{{$totalscore->account->levels->first()->image}}" width="50">
</div>
</li>
@endforeach


@stop