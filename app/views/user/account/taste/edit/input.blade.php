<?php
	$tastes = Config::get('app.tastes');
	$tasteValues = $tastes[$permission];
?>

@if (array_key_exists('values', $tastes))
<label class="checkbox">
	<div class="checker" id="uniform-undefined">
		@foreach ($permissionValues['values'] as $key => $title)
		<?php
			$checked = false;

			if (
				array_key_exists($permission, $checkedPermissions) &&
				$checkedPermissions[$permission] === $key
			)
			{
				$checked = true;
			}
		?>
		{{ Form::radio('permissions[' . $permission . ']', $key, $checked) }}
		{{ $title }}<br>
		@endforeach
	</div>
</label>
@else
<?php
	$checked = array_key_exists($permission, $checkedTastes) ? true: false;
?>
<label class="checkbox">
	<div class="checker" id="uniform-undefined">
		{{ Form::checkbox('tastes[' . $permission . ']',1,$checked) }}
	</div> {{ $tasteValues['title'] }}
</label>
@endif

