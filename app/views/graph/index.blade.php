@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<h2>Graph</h2>
<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
 
		<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
 
			<!-- Be sure to leave the brand out there if you want it shown -->
			<a class="brand" href="#">Graphics</a>
 
			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse collapse">
			<!-- .nav, .navbar-search, .navbar-form, etc -->
			<ul class="nav">
			</ul>
			<form class="navbar-search pull-right" action="">
                 <input type="text" class="search-query span2" id="searchData" placeholder="Search">
			</form>
			</div>
		</div>
	</div>
</div>
</div>

<div class="row span12">
	<div class="graphposts span12">
		
		@foreach ($graphposts as $graphpost)
			
			<div class="box">
				<a href="{{ URL::action('PostController@showGraph', array($graphpost->id)) }}">
				<div class="view view-first">
					<img src="{{ $graphpost->image->getSize('original')->getPathname() }}">
					<div class="mask">
     					<h2>{{$graphpost->title}}</h2>  
     					<p>{{$graphpost->body}}</p>    
     				</div>

				</div>
				</a>
			<div class="viewslikes span2">
        		<div class="pull-left">
        			<div class="pull-left">
        				<i class='icon-eye-open'>
        				<span class="badge badge-inverse">{{$graphpost->views}}</span></i>
        			</div>
        		</div>
        		
        		<div class="">
        			<div class="pull-left likes">
        				<i class='icon-heart'></i>
        				<span class="badge badge-inverse">{{count($graphpost->likes)}}</span></i>
        			</div>
        			<div class="pull-right">
        			<a href="{{ URL::action('UserController@visitAccount',array($graphpost->createdBy()->id)) }}">
    						@if($graphpost->createdBy()->accountUser()->image_id != 0 or $graphpost->createdBy()->accountUser()->facebookpic == NULL )
								<img src="{{ url($graphpost->createdBy()->accountUser()->getImagePathname()) }}" width="25" alt="">
							@else
								<img src="{{ url($graphpost->createdBy()->accountUser()->facebookpic) }}" width="25" alt="">
							@endif
						</a>
					</div>
        		</div>
        	</div>
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

@section('scripts')
	@parent

$("#graph").addClass('active');

@stop