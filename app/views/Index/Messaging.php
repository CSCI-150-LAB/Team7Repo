<?php

$users = array_map(function($user) {
	return [
		'id' => $user->id,
		'firstName' => $user->firstName,
		'lastName' => $user->lastName,
		'fullName' => $user->getFullName()
	];
}, User::find());

$this->scriptEnqueue('vuejs', 'https://cdn.jsdelivr.net/npm/vue@2.6.12');
VueLoader::render(APP_ROOT . '/app/vue-components/chat-form.vue', '#messaging-app');
?>

<script>
	var userList = <?= json_encode($users) ?>;
</script>

<div id="messaging-app">
	<chat-form></chat-form>
</div>