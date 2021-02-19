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
							<div v-for="user in userList" class="row user-row" v-bind:class="selectedUserId == user.id ? 'selected' : ''" v-bind:key="user.id" v-on:click="joinChatRoom(user.id)" >
								<div> <img v-bind:src="publicUrl('images/blank_avatar.png')" width="50" height="50" alt="blank_avatar" class="mr-md-4 mb-3 img-fluid"> </div>
								<div> {{user.fullName}} </div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- List of messages above, selected message group below -->

			<div class="col">
				<div class="card p-4">
					<div ref="log" class="message-log">
						<div v-for="chat in chatLog" v-bind:key="chat.createdAt" class="item" v-bind:class="getMessageClasses(chat)">
							{{chat.message}}
						</div>
					</div>
					<form class="messaging-form" v-on:submit="submit">
						<div class="input-group">
							<input type="text" class="form-control" v-model="messageTxt" placeholder="Message">
							<button type="submit" class="btn btn-primary" v-bind:disabled="!isSocketConnected"><i class="fas fa-paper-plane"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		mixins: [VueMixin, SocketHandler.getVueMixin()],

		data() {
			return {
				selectedUserId: 0,
				currentConversationId: 0,
				userList: window.userList,
				messageTxt: '',
				chatLog: []
			};
		},

		created() {
			this.socketOn('JoinChatRoom', ({ conversationId }) => {
				this.chatLog = [];
				this.currentConversationId = conversationId;
			});

			this.socketOn('Chat', (obj) => {
				this.chatLog.push(obj);
			});
		},

		methods: {
			submit(e) {
				e.preventDefault();

				this.socketSend('Chat', {
					message: this.messageTxt
				});
				this.messageTxt = '';
			},

			joinChatRoom(userId) {
				this.selectedUserId = userId;
				this.socketSend('JoinChatRoom', { withUserId: userId });
			},

			getMessageClasses(chat) {
				return {
					[chat.authorId == SocketHandler.userInfo.userId ? 'me' : 'them']: true
				}
			}
		}
	}
</script>

<style scoped>
	.user-list {
		height: 500px;
		overflow-y: scroll;
	}

	.user-row {
		cursor: pointer;
	}
	.user-row:hover,
	.user-row.selected {
		background-color: #faa;
	}

	.message-log {
		height: 475px;
		overflow-y: scroll;
	}

	.message-log .item.me {
		text-align: right;
	}
</style>