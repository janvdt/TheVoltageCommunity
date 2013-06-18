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
		
	</div>
</li>
@endforeach


@stop