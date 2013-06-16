@extends('instance.layout')

@section('instanceContent')

<h2>Choose you're own taste of music</h2>
<div class="row">
	<div class="span12">
		<div class="row">
			<div class="span12">
				<form class="form-horizontal" method="POST" action="{{ URL::action('AccountController@updateTaste', array($account->id)) }}" >
				<input type="hidden" name="_method" value="POST">
				<fieldset>	
					<h3>Let's see what we got here</h3>
					{{ View::make('user.account.taste.edit.input')->with('permission', 'Electronic')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes)}}
					{{ View::make('user.account.taste.edit.input')->with('permission', 'Hiphop')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
					{{ View::make('user.account.taste.edit.input')->with('permission', 'House')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
					{{ View::make('user.account.taste.edit.input')->with('permission', 'Dance')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
					{{ View::make('user.account.taste.edit.input')->with('permission', 'Drum&bass')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
					{{ View::make('user.account.taste.edit.input')->with('permission', 'Dubstep')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
					{{ View::make('user.account.taste.edit.input')->with('permission', 'Pop')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
					{{ View::make('user.account.taste.edit.input')->with('permission', 'Indie')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
				</fieldset>
				<div class="form-actions">
					<a class="btn" href="{{ URL::action('UserController@showAccount', array($account->id))}}">Cancel</a>
					<input type="submit" class="btn btn-inverse" value="Save">
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

@stop