<template>
	<div class="radio-group builder-option-group field-input-group">
		<div class="options-list">
			<div v-for="(item, ndx) in options" :key="ndx" class="input-group mb-1">
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

		<button type="button" class="btn btn-primary btn-add-option" v-on:click="$emit('add-option')">Add Option</button>
	</div>
</template>

<script>
	export default {
		props: ['type', 'options']
	}
</script>