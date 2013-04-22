@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<h2>Graph</h2>
</div>
<div class="row span12">
	<div class="graphposts span12">
		
		@foreach ($graphposts as $graphpost)
			<div class="box">
				<a href="#">
				<div class="view view-first">
					<img src="{{ $graphpost->image->getSize('original')->getPathname() }}">
					<div class="mask">  
     					<h2>{{$graphpost->title}}</h2>  
     					<p>{{$graphpost->body}}</p>    
     				</div>  
				</div>
				</a>  
			</div>
		@endforeach
		
	</div>
</div>

<div class="row">
		<div class="span12">
			<div class="pagination pagination-centered">
				{{ $graphposts->links() }}
			</div>
		</div>
	</div>



@stop