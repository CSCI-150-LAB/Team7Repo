<template>
	<div class="messaging-form">
		<div class="row">
			<div class="col-6">
				<div class="card p-4">
					<div class="row">
						<select class="selectpicker" data-live-search="true" multiple title="Contacts">
							<option v-for="user in sortedContactList" :key="user.id" :value="user.id" class="contacts">{{user.fullName}}</option>
						</select>
						<button type="button" class="btn btn-secondary float-right" data-placement="right" title="Start New Conversation" aria-haspopup="true" aria-expanded="false" v-on:click="joinChatRoom($('.selectpicker').val())">
							<i class="fas fa-edit"></i>
						</button>
					</div>
					<div class="row">Recent Messages</div>
					<div class="row">
						<div class="col user-list">
							<div v-for="(convoUsers, convoId) in conversationList" class="row user-row" v-bind:class="currentConversationId == convoId ? 'selected' : ''" v-bind:key="convoId" v-on:click="joinChatRoom(convoUsers, convoId)">
								<div v-for="userId in convoUsers" v-bind:key="userId">
									<div v-if="userId !== currentid" class="col">
										<img v-bind:title="getUserName(userId)" v-bind:src="publicUrl('images/blank_avatar.png')">
										{{getUserName(userId)}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- List of messages above, selected message group below -->

			<div class="col">
				<div class="card p-4">
					<div ref="log" class="message-log">
						<div v-for="chat in chatLog" v-bind:key="chat.createdAt" class="item">
							<div v-if="chat.authorId !== currentid" class="sender">
								<img v-bind:title="getUserName(chat.authorId)" v-bind:src="publicUrl('images/blank_avatar.png')">
								{{getUserName(chat.authorId)}}
							</div>
							<div class="item" v-bind:class="getMessageClasses(chat)">
								{{chat.message}}
							</div>
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
				currentConversationId: 0,
				userList: window.contactList.reduce((acc, cur) => {
					acc[cur.id] = cur;
					return acc;
				}, {}),
				conversationList: window.conversationList.reduce((acc, cur) => {
					acc[cur.id] = cur.users;
					return acc;
				}, {}),
				messageTxt: '',
				chatLog: []
			};
		},

		created() {
			this.socketOn('JoinChatRoom', ({ conversationId, withUserIds }) => {
				if (!this.conversationList[conversationId]) {
					this.$set(this.conversationList, conversationId, withUserIds);
				}
			});

			this.socketOn('Chat', (obj) => {
				this.chatLog.push(obj);
			});
		},

		computed: {
			sortedContactList() {
				return Object.values(this.userList)
					.map(u => {
						return {
							...u,
							online: this.connectedUsers.includes(u.id)
						};
					})
					.sort((a, b) => {
						let ret = b.online - a.online;
						if (ret == 0) {
							ret = a.fullName.localeCompare(b.fullName);
						}

						return ret;
					});
			}
		},

		methods: {
			submit(e) {
				e.preventDefault();

				this.socketSend('Chat', {
					message: this.messageTxt
				});
				this.messageTxt = '';
			},

			joinChatRoom(userIds, conversationId = 0) {
				if (!Array.isArray(userIds)) {
					userIds = [userIds];
				}
				
				this.currentConversationId = conversationId;
				this.chatLog = [];
				this.socketSend('JoinChatRoom', { withUserIds: userIds });
			},

			getMessageClasses(chat) {
				return {
					[chat.authorId == SocketHandler.userInfo.userId ? 'me' : 'them']: true
				}
			},

			getUserName(userId) {
				if (userId == SocketHandler.userInfo.userId) {
					return SocketHandler.userInfo.fullName;
				}
				
				return this.userList[userId].fullName;
			},

			getUserListClasses(user) {
				return {
					online: user.online
				};
			}
		}
	}
</script>

<style scoped>
	.user-list {
		height: 500px;
		overflow-y: scroll;
	}

	.user-list img {
		max-width: 50px;
	}

	.user-row {
		cursor: pointer;
		border: 1px solid black;
    	border-radius: 20px;
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
		text-align: left;
		color: white;
    	background-color: red;
    	margin-bottom: 10px;
    	margin-left: calc(100% - 210px);
    	padding: 10px;
    	width: 200px;
    	height: auto;
    	border: 1px solid black;
    	border-radius: 20px;
	}

	.message-log .item.them {
		text-align: left;
		color: white;
		background-color: blue;
		width: 200px;
		margin-left: 10px;
		margin-bottom: 10px;
		padding: 10px;
    	height: auto;
		border: 1px solid black;
		border-radius: 20px;
	}

	.contacts:after {
		font-family: "Font Awesome 5 Free";
		font-weight: 900;
		content: '\f111 ';
		color: red;
		margin-left: 4px;
		font-size: 8px;
		position: relative;
		top: -4px;
	}

	.contacts.online:after {
		color: green;
	}

	.sender {
		color: black;
	}

	.sender img {
		max-width: 20px;
		border-radius: 50%;
	}
	
</style>