<template>
	<div class="messaging-form">
		<form class="messaging-form" v-on:submit="submit">
			<div class="form-group">
				<label for="message">Message</label>
				<input type="text" class="form-control" v-model="messageTxt">
			</div>

			<button type="submit" class="btn btn-primary" v-bind:disabled="!isSocketConnected">Submit</button>
		</form>

		<div ref="log"></div>
	</div>
</template>

<script>
	export default {
		mixins: [SocketHandler.getVueMixin()],

		data() {
			return {
				messageTxt: ''
			};
		},

		created() {
			this.socketOn('_authenticated', () => {
				this.socketSend('JoinChatRoom');
			});

			this.socketOn('Chat', ({ message }) => {
				this.log(message);
			});
		},

		methods: {
			log(msg) {
				$(this.$refs.log).append($('<div/>').text(msg));
			},

			submit(e) {
				e.preventDefault();

				SocketHandler.send('Chat', {
					message: this.messageTxt
				});
				this.messageTxt = '';
			}
		}
	}
</script>