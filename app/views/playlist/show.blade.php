@extends('instance.layout')

@section('instanceContent')

<div class ="span12 music">
<div class="row">
	<div class="span10">
		<h2>{{$playlist->title}}</h2>
	</div>
	<div class="span2">
		<a id="buttonremove" class="btn btn-danger pull-right" href="#delete-selected" data-toggle="modal">Remove selected</a>
	</div>
</div>
<div class="row">
<div class="span6 offset2 youtubeplaylist">
	@if($playlist->posts->first() != NULL and $playlist->type == 'youtube')
	<div class="youtubeplayer">
    <div class="yt_holder">
        <div id="ytvideo" style="z-index:1;"></div>
            <!--Up and Down arrow -->
  			<div class="you_up"><img src="/images/up_arrow.png" alt="+ Slide" title="HIDE" /></div>
  			<div class="you_down"><img src="/images/down_arrow.png" alt="- Slide" title="SHOW" /></div>
            <!-- END  -->
			<div class="youplayer">
				<ul class="videoyou">
	            <?php
	            /***************************************************************************
	            //youtube playlist jquery plugin Html5 Gdata Api v2  : 4.0
	            //released:             : Sep 12 2012
	            //copyright             : Copyright © 2012 cfconsultancy
	            //email                 : info@cfconsultancy.nl
	            //website               : http://www.cfconsultancy.nl
	            ***************************************************************************/
	            // Use like this.
	            include_once('class/class.youtubelist.php');

                

                //This part is the foreach list
	            if ( $playlist->posts !=null ) {
	                foreach ($playlist->posts as $musicpost) {
	                    echo '<li><p>' . $musicpost->title . '</p><span class="time">' . 100 . '</span><a class="videoThumb" href="http://www.youtube.com/watch?v=' . $musicpost->youtube . '">' . $musicpost->body . '</a></li>';
	                }
	            }else{
	                echo '<li>Sorry, no video\'s found</li>';
	            }
	            //End list
	            ?>
       			</ul>
	      		<!-- remove this if you don't want anyone to change the results -->
	      		<!-- END -->
        </div>
        <!-- Remove if you don't want the footer shadow -->
        <div style="height:0px; font-size:0em;clear:both;">&nbsp;</div>
        <div class="ytfooter">&nbsp;</div>
        <!-- END -->
    </div>
</div>
@endif
</div>
</div>
<!-- END youtube player -->
<div class="row">
	<ul class="ch-grid playlistgrid nav nav-pills music-posts" id="sortableplaylist">
		@foreach ($playlist->posts as $musicpost)
    		<li class= "musicpost" id="{{$musicpost->id}}" value="{{$musicpost->id}}">
    			<div class="row" data-playlist-id="{{ $playlist->id }}" data-post-id="{{ $musicpost->id }}">
    				@if($playlist->account_id == Auth::user()->accountUser()->id)
    				<label class="pull-right">
						{{Form::checkbox('remove[]', $musicpost->id)}}
					</label>
					@endif
    				<div class="span3 titlemusicpost">
    					<h6>
    						
    						<?php $string = $musicpost->title;
							$maxLength = 50;

						if (strlen($string) > $maxLength) {
    					$stringCut = substr($string, 0, $maxLength);
    					$string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
						}

						echo stripslashes("$string</h6>")
						?>
						
    					</div>
    				</div>
    				
    					
    				<div class="test">
    					
        			@if($musicpost->soundcloud_art != NULL)
        			<a href="{{$musicpost->soundcloud}}" class="stratus">
        			<div class="ch-item ch-img-1 soundcloudimg" style="background-image: url({{$musicpost->soundcloud_art}});">
        			@else
        			<a value="{{$musicpost->youtube}}" id="play" class="playyoutube">
        			<div class="ch-item ch-img-1 youtubeimg" style="background-image: url({{$musicpost->youtube_art}});">
        			@endif
        		
        				
        			</div>
        			</a>
        		</div>

        			<div class="viewslikes span2">
        				<div class="pull-left">
        					<div class="pull-left">
        						
        					</div>
        				</div>
        			</div>
        			
        			<div class="shelf shelfmusicpost">
					<div class="bookend_left"></div>
					<div class="bookend_right"></div>
					<div class="reflection"></div>
					</div>

    			</li>
    			
    			
    		@endforeach
		</ul>
	</div>
</div>



<div class="modal hide fade" id="delete-selected">
	<form class="form-horizontal" method="POST" action="{{ URL::action('PlaylistController@destroySelected') }}?playlist={{$playlist->id}}">
		<div class="modal-header">
			<input type="hidden"  id="removeposts" name="removeposts">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h3>Delete selected songs</h3>
		</div>
		<div class="modal-body">
			<p>Are you sure you want to delete the selected songs from this playlist?</p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Cancel</button>
			<input class="btn btn-danger" type="submit" value="Delete">
		</div>
	</form>
</div>


@stop

@section('scripts')
	@parent


$("musicpost").stratus({
      links: '<?php echo(implode(",", $soundcloudsurl)); ?>',
      random: false,
      color: 'c6e2cc'
              
    });
$('.music').on('click',".playyoutube",function() {

 	var youtube = $(this).attr('value');

 	console.log(youtube);

 	 jQuery.iLightBox([
		{
			URL: "http://www.youtube.com/embed/"+ youtube + ""
		}
	]);
	
});

$( "#sortableplaylist" ).sortable({
	handle:'div',
	items: 'li',
	listType:'ul',
	maxLevels:'1',
	toleranceElement: 'div',
	start:function(event, ui)
	{
		list = $('ul.sortable').nestedSortable('toArray');
		old_position = ui.item.index();
		
	},
	update:function(event, ui){

		var playlist_id = ui.item.find('> div').attr('data-playlist-id');
		var post_id = ui.item.find('> div').attr('data-post-id');
		list = $('ul.sortable').nestedSortable('toArray');
		index = ui.item.index();
		console.log(index);
		console.log(playlist_id);
		console.log(post_id);
		console.log(old_position);
		


		$.post('/playlist/orderplaylist/' + playlist_id, { index : index, old_position : old_position, post_id : post_id },
		function(data)
		{
				console.log(data);	
		});
	}
	
});

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

	if ($('.music-posts li').length == 0) {
	$('.music').append("<h3>Oops...</h3> <h5>this playlist is empty. Go and make this playlist rock!</h5>")
	$('#buttonremove').hide();
	}
@stop