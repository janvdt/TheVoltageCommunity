@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
	<div class="span8 pull-left">
		<h2>Let us know what you think!</h2>
	</div>
	@if(Auth::user())
	<div class="row">
		<div class="span11 offset1 commentsection">
			
			<div class="row">
				<div class="writecomment">
					<form class="form-horizontal" method="POST" action="{{ URL::action('FeedbackController@store')}}"  id="upload-feedback-form">
						<div class="span2 commentpost">
							@if(Auth::user()->accountUser()->identifier == 0)
								<a href="{{ URL::action('UserController@visitAccount',array(Auth::user()->id)) }}">
									<img class="img-rounded" src="{{ url(Auth::user()->accountUser()->getImagePathname()) }}" alt="" width="75">
								</a>
							@else
							<a href="{{ URL::action('UserController@visitAccount',array(Auth::user()->id)) }}">
								<img class="img-rounded" src="{{ url(Auth::user()->accountUser()->facebookpic) }}" alt="" width="75">
							</a>
							@endif
						</div>
							<div class="control-group">
								<div class="controls">
									<textarea name="textcomment" class="input-xxlarge pull-left" id="commenttext" rows="3" placeholder="Enter text ..."></textarea>
								</div>
							</div>	
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
	@endif
	<div class="row commentsattach">
	@foreach($feedbacks as $feedback)
	
		<div class="span11 offset1 commentsection2">	
			<div class="comments">
				<div class="well commentpost feedback">
					
					<div class="row">
						<div class="span5 pull-right">
							<h6 class="pull-right">Posted by: {{$feedback->account->user->first_name}} {{$feedback->account->user->last_name}}</h6>
						</div>
					</div>

					<div class="row">

						<div class="span1">
							@if($feedback->account->identifier == 0)
								<a href="{{ URL::action('UserController@visitAccount',array($feedback->account->user->id)) }}">
									<img class="img-rounded" src="{{ url($feedback->account->getImagePathname()) }}" alt="" width="75">
								</a>
							@else
								<a href="{{ URL::action('UserController@visitAccount',array($feedback->account->user->id)) }}">
									<img class="img-rounded" src="{{ url($feedback->account->facebookpic) }}" alt="" width="75">
								</a>
							@endif
						</div>

						<div class="span7">
							<p class="postbody feedbackbody">{{$feedback->text}}</p>
						</div>
					</div>
					<div class="row">
						<div class="span5 pull-right">
							<h6 class="pull-right">{{$feedback->created_at}}</h6>
						</div>
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
			{{ $feedbacks->links() }}
		</div>
	</div>
</div>



@stop

@section('scripts')
	@parent

	$("#feedback").addClass('active');

		$("#commenttext").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#upload-feedback-form").submit();
        $("#commenttext").val('');
    }
});

@if(Auth::user())
// Ajax file upload for the file upload modal.
$("#upload-feedback-form").ajaxForm({
	data: { 'ajax': 'true' },
	dataType: 'json',
	success: function(data) {
	console.log(data.date.date);
	
			
	var comment = "<div class='span11 offset1 commentsection2'><div class='comments'><div class='well commentpost feedback' id='comment"+ data.id +"'><div class='row'><div class='span5 pull-right'><h6 class='pull-right'>Posted by: {{Auth::user()->first_name}} {{Auth::user()->last_name}}</h6></div></div><div class='row'><div class='span1'>@if(Auth::user()->accountUser()->identifier == 0)<a href='{{ URL::action('UserController@visitAccount',array(Auth::user()->id)) }}'><img class='img-rounded' src='{{ url(Auth::user()->accountUser()->getImagePathname()) }}' alt='' width='75'></a>@else<a href='{{ URL::action('UserController@visitAccount',array(Auth::user()->id)) }}'><img class='img-rounded' src='{{ url(Auth::user()->accountUser()->facebookpic) }}' alt='' width='75'></a>@endif</div><div class='span7'><p class='postbody feedbackbody'>"  + data.body + "</p></div></div><div class='row'><div class='span5 pull-right'><h6 class='pull-right'>" + data.date.date + "</h6></div></div></div></div></div>";
	
	$(".commentsattach").append(comment);

	// Hide the upload modal.
	$("#comment-post").modal('hide');

	}
});
@endif

$('.pagination ul li:not(:last)').remove();
$('.pagination').hide();
// infinitescroll() is called on the element that surrounds 
// the items you will be loading more of
  $('.commentsattach').infinitescroll({
 
    navSelector  : ".pagination",            
                   // selector for the paged navigation (it will be hidden)
    nextSelector : ".pagination ul li a",    
                   // selector for the NEXT link (to page 2)
    itemSelector : ".commentsection2",          
                   // selector for all items you'll retrieve
    loading: {
        finished: undefined,
        finishedMsg: "",
        img: "/images/loader.gif",
        msg: null,
        msgText: "",
        selector: null,
        speed: 'fast',
        start: undefined
    }
    },
  // trigger Masonry as a callback
  function( newElements ) {
   
});


@stop