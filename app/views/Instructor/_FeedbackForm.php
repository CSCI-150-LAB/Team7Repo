<?php
	$class = $class ?? (object)['class' => '', 'classid' => 0];

	// Load extra assets for the feedback form code
	$this->scriptEnqueue('vuejs', 'https://cdn.jsdelivr.net/npm/vue@2.6.12');

	// Load vue components
	VueLoader_Loader::render(glob(APP_ROOT . '/app/vue-components/feedback-form/*.vue'), '#feedback-app');
?>

<div class="modal fade" id="feedback-app">
	<div class="modal-dialog modal-xl">
		<form-app></form-app>
	</div>
</div>

<script>
	var feedbackFormDefaults = {
		classId: <?php echo json_encode($class->classid) ?>,
		classTitle: <?php echo json_encode($class->class) ?>
	};
</script>