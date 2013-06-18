@extends('instance.layout')

@section('instanceContent')

<h2>Look who's winning</h2>
<ul class="nav">
@foreach($totalscores as $totalscore)
<li>
	{{$totalscore->value}}
</li>
@endforeach


@stop