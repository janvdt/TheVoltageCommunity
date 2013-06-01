<?php
	$tastes = Config::get('app.tastes');
	$tasteValues = $tastes[$permission];
?>
<?php
	$checked = array_key_exists($permission, $checkedTastes) ? true: false;
?>
<label class="checkbox">
	<div class="checker" id="uniform-undefined">
		{{ Form::checkbox('tastes[' . $permission . ']',1,$checked) }}
	</div>
</label>