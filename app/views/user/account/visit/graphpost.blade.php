@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<div class="row">
	<div class="span10">
		<h2>{{$user->first_name}} {{$user->last_name}} Graphic posts</h2>
	</div>
	<div class="span2">
		@if(Auth::user()->id == $user->id)
		<a id="buttonremove" class="btn btn-danger pull-right" href="#delete-selected" data-toggle="modal">Remove selected</a>
		@endif
	</div>
</div>
</div>
<div class="row span12">
	<div class="graphposts span12">
		
		@foreach ($graphposts as $graphpost)
			
			<div class="box">
				<div class="pull-right">
						@if($graphpost->created_by == Auth::user()->id)
							<a href="{{ URL::action('PostController@editGraph', array($graphpost->id)) }}" ><i class='icon-pencil'></i></a>
						@endif
						</div>
						@if($graphpost->created_by == Auth::user()->id)
    					<label class="pull-right">
						{{Form::checkbox('remove[]', $graphpost->id)}}
						</label>
						@endif
				<a href="{{ URL::action('PostController@showGraph', array($graphpost->id)) }}">
				<div class="view view-first">
					<img src="{{url($graphpost->image->getSize('original')->getPathname()) }}">
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

<div class="modal hide fade" id="delete-selected">
	<form class="form-horizontal" method="POST" action="{{ URL::action('PostController@destroygraphSelected') }}">
		<div class="modal-header">
			<input type="hidden"  id="removeposts" name="removeposts">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h3>Delete selected graphics</h3>
		</div>
		<div class="modal-body">
			<p>Are you sure you want to delete the selected graphics</p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Cancel</button>
			<input class="btn btn-danger" type="submit" value="Delete">
		</div>
	</form>
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

  function Populate(){
    vals = $('input[type="checkbox"]:checked').map(function() {
        return this.value;
    }).get().join(',');
    console.log(vals);
    $('#removeposts').val(vals);
	}

	$('input[type="checkbox"]').on('change', function() {
    Populate()
    $('#buttonremove').show();

    if(!$('#removeposts').val()){
	$('#buttonremove').hide();
	}
	}).change();
@stop