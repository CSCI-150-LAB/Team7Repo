<?php

$this->scriptEnqueue('vuejs', 'https://cdn.jsdelivr.net/npm/vue@2.6.12');
VueLoader::render(APP_ROOT . '/app/vue-components/chat-form.vue', '#messaging-app');
?>

<div id="messaging-app">
	<chat-form></chat-form>
</div>