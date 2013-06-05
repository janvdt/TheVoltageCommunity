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
	<ul class="ch-grid nav nav-pills music-posts" id="sortableplaylist">
		@foreach ($playlist->posts as $musicpost)
    		<li class= "musicpost" id="{{$musicpost->id}}" value="{{$musicpost->id}}">
    			<div class="row" data-playlist-id="{{ $playlist->id }}" data-post-id="{{ $musicpost->id }}">
    				<label class="pull-right">
						{{Form::checkbox('remove[]', $musicpost->id)}}
					</label>
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
    				
    					
    				@if($musicpost->image_id != 0)
        			<div class="ch-item ch-img-1" style="background-image: url(/{{ $musicpost->image->getSize('thumb')->getPathname() }});">
        			@else
        			@if($musicpost->soundcloud_art != NULL)
        			<div class="ch-item ch-img-1 soundcloudimg" style="background-image: url({{$musicpost->soundcloud_art}});">
        			@else
        			<div class="ch-item ch-img-1 youtubeimg" style="background-image: url({{$musicpost->youtube_art}});">
        			@endif
        			@endif
        				
        			</div>

        			<div class="viewslikes span2">
        				<div class="pull-left">
        					<div class="pull-left">
        						<a href="{{$musicpost->soundcloud}}" class="stratus"><i class="icon-play"></i></a>
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
@stop