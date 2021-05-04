<template>
	<div class="radio-group builder-option-group field-input-group">
		<div v-for="(item, ndx) in options" :key="ndx" class="row">
			<div v-bind:class="isQuiz ? 'col-xl-9' : 'col-xl-12'">
				<div class="options-list">
					<div class="input-group mb-1">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i v-if="type == 'CHECKBOX_GROUP'" class="far fa-square"></i>
								<i v-else class="far fa-circle"></i>
							</span>
						</div>
						<input type="text" class="form-control" :value="item" v-bind:placeholder="'Option #' + (ndx + 1)" v-on:input="$emit('update-option', {ndx: ndx, val: $event.target.value})" required>
						<div class="input-group-append">
							<button type="button" class="btn btn-danger btn-delete" v-bind:disabled="options.length <= 2" v-on:click="$emit('remove-option', ndx)"><i class="fas fa-trash"></i></button>
						</div>
					</div>
				</div>
			</div>
			<div v-if="isQuiz" class="col-xl-3">
				<div class="form-check form-check-inline">
					<input v-if="type == 'CHECKBOX_GROUP'" class="form-check-input" type="checkbox" v-bind:id="`answer-${id}-${ndx}`" v-bind:checked="answer[ndx]" v-on:input="$emit('update-answer', {ndx, val: answer[ndx] ? 0 : 1})">
					<input v-else class="form-check-input" type="radio" v-bind:name="`answer-${id}`" v-bind:id="`answer-${id}-${ndx}`" v-bind:checked="ndx == answer[0]" v-on:input="$emit('update-answer', {ndx: 0, val: ndx})">
					<label class="form-check-label" v-bind:for="`answer-${id}-${ndx}`">Answer</label>
				</div>
			</div>
		</div>

		<button type="button" class="btn btn-primary btn-add-option" v-on:click="$emit('add-option')">Add Option</button>
	</div>
</template>

<script>
	export default {
		props: ['id', 'type', 'options', 'answer', 'isQuiz']
	}
</script>