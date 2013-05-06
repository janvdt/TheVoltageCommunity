<ul id="menulist" class="nav nav-tabs nav-stacked">
	@foreach ($comments as $comment)
		<li>
			<a href="">
				{{ $comment->body }}
			</a>

			@if (!is_null($current_comment) and $current_comment->hasParent($comment->id))
				{{ View::make('post.comment')->with('comments', $comment->comments)->with('current_comment', $current_comment) }}
			@endif
		</li>
	@endforeach
</ul>