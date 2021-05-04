<template functional>
	<input v-if="props.isQuiz" placeholder="Answer" type="text" class="form-control field-short-text" v-bind:value="props.answer[0]" v-on:input="listeners['update-answer']({ndx: 0, val: $event.target.value})">
	<span v-else></span>
</template>