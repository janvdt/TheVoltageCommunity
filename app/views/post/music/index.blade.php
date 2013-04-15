@extends('instance.layout')

@section('instanceContent')

<div class="span12">
	<div class="span11">
	<a href="{{ URL::action('PostController@editMusic', array($post->id)) }}" class="btn btn-primary pull-right">Edit post</a>
	<h4>{{$post->title}}</h4>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div class="span4">
		<img class="avatar img-polaroid" src="/{{ $post->image->getSize('medium')->getPathname() }}" alt="">
	</div>
	<div class="span7">
		<div class="postsoundcloud">
		<?php
			require_once 'Services/Soundcloud.php';
			// create a client object with your app credentials
			$client = new Services_Soundcloud('b4479c54bc012db248c6bf606545d409', '3938d333342c58f6d5fd9febef26e7ed');
			$client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));

			// get a tracks oembed data
			$track_url = $post->soundcloud;
			$embed_info = json_decode($client->get('oembed', array('url' => $track_url)));
	
			// render the html for the player widget
			print $embed_info->html;
			?>
		</div>
		<div>
		<p>{{$post->body}}</p>
		</div>
	</div>
</div>

@stop