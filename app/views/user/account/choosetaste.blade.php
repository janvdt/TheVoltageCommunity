@extends('instance.layout')

@section('instanceContent')
<div class="row">
	<div class="span12 content">
		<div class="span9">
			<h2>Choose you're own taste of music</h2>
		</div>
		<div class="pull-right">
			<h3>Step 3/3 </h3>
		</div>
		<div class="row">
			<div class="span12">
				<div class="row">
					<div class="span8">
						<form class="form-horizontal" method="POST" action="{{ URL::action('AccountController@updateprofiletaste', array(Auth::user()->accountUser()->id)) }}" >
						<input type="hidden" name="_method" value="POST">
						<fieldset class="offset1">	
							<h3>I really like..</h3>
							{{ View::make('user.account.taste.edit.input')->with('permission', 'Electronic')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes)}}
							{{ View::make('user.account.taste.edit.input')->with('permission', 'Hiphop')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
							{{ View::make('user.account.taste.edit.input')->with('permission', 'House')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
							{{ View::make('user.account.taste.edit.input')->with('permission', 'Dance')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
							{{ View::make('user.account.taste.edit.input')->with('permission', 'Drum&bass')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
							{{ View::make('user.account.taste.edit.input')->with('permission', 'Dubstep')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
							{{ View::make('user.account.taste.edit.input')->with('permission', 'Pop')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
							{{ View::make('user.account.taste.edit.input')->with('permission', 'Indie')->with('checkedTastes', $checkedTastes)->with('tastes', $tastes) }}
						</fieldset>
						<div class="form-actions span10">
							<input type="submit" class="btn btn-inverse pull-right" value="Complete">
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop