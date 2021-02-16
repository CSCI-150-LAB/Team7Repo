<template>
	<div class="messaging-form">
		<div class="row">
			<div class="col-4">
				<div class="card p-4">
					<div class="row">
						<div class="col-8">Recent Messages</div>
						<div class="col">
							<button type="button" class="btn btn-secondary float-right" data-toggle="tooltip" data-placement="right" title="Start New Conversation">
								<i class="fas fa-edit"></i>
							</button>
						</div>
					</div>
					<div class="row">
						<div class="col user-list">
							<div v-for="user in userList" class="row" v-bind:key="user.id">
								<div> <img v-bind:src="baseUrl('public/images/blank_avatar.png')" width="50" height="50" alt="blank_avatar" class="mr-md-4 mb-3 img-fluid"> </div>
								<div> {{user.fullName}} </div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- List of messages above, selected message group below -->

			<div class="col">
				<div class="card p-4">
					<div ref="log" class="message-log"></div>
					<form class="messaging-form" v-on:submit="submit">
						<div class="input-group">
							<input type="text" class="form-control" v-model="messageTxt" placeholder="Message">
							<button type="submit" class="btn btn-primary" v-bind:disabled="!isSocketConnected"><i class="fas fa-search"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		mixins: [SocketHandler.getVueMixin()],

		data() {
			return {
				userList: window.userList,
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
			baseUrl(url) {
				return window.BASEURL + (url || '').replace(/^\//, '');
			},

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

<style scoped>
	.user-list {
		height: 500px;
		overflow-y: scroll;
	}
	.message-log {
		height: 475px;
		overflow-y: scroll;
	}
</style>