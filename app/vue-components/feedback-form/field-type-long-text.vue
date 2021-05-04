<template functional>
	<textarea v-if="props.isQuiz" placeholder="Answer" type="text" class="form-control field-long-text" v-bind:value="props.answer[0]" v-on:input="listeners['update-answer']({ndx: 0, val: $event.target.value})"></textarea>
	<span v-else></span>
</template>