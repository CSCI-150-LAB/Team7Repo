<template>
	<div class="messaging-form">
		<div class="row">
			<div class="col-md-6">
				<div class="card p-4 mb-3 mb-md-0">
					<div class="row mb-3">
						<div class="col">
							<div class="input-group">
								<select ref="bsSelect" class="selectpicker form-control" data-none-selected-text="Pick people to chat with" multiple data-icon-base="">
									<option v-for="user in sortedContactList" v-bind:key="user.id" v-bind:data-icon="getContactIcon(user)" v-bind:value="user.id">{{user.fullName}}</option>
								</select>
								<div class="input-group-append">
									<button type="button" class="btn btn-primary" v-on:click="createChatRoom()"><i class="fas fa-edit"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row">Recent Messages</div>
					<div class="row">
						<div class="col user-list">
							<div v-for="(convoUsers, convoId) in conversationList"
								class="row user-row"
								v-bind:class="currentConversationId == convoId ? 'selected' : ''"
								v-bind:key="convoId"
								v-on:click="joinChatRoom(convoUsers, convoId)"
							>
								<div class="col">
									<div v-for="userId in convoUsers" v-bind:key="userId" class="user-item" v-bind:class="userId != currentUserId ? 'd-inline-block' : 'd-none'">
										<i class="fas fa-circle" v-bind:class="isUserOnline(userId) ? 'online' : ''"></i> {{getUserName(userId, 'fullName')}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- List of messages above, selected message group below -->

			<div class="col-md-6">
				<div class="card h-100 p-4 d-flex flex-column">
					<div ref="log" class="message-log flex-grow-1">
						<chat-bubble v-for="(chat, ndx) in chatLog" v-bind:key="chat.createdAt" v-bind:chat="chat" v-bind:previous-chat="ndx > 0 ? chatLog[ndx - 1] : null"></chat-bubble>
						<!-- <div v-for="chat in chatLog" v-bind:key="chat.createdAt" class="item">
							<div v-if="chat.authorId !== currentid" class="sender">
								<img v-bind:title="getUserName(chat.authorId)" v-bind:src="publicUrl('images/blank_avatar.png')">
								{{getUserName(chat.authorId)}}
							</div>
							<div class="item" v-bind:class="getMessageClasses(chat)">
								{{chat.message}}
							</div>
						</div> -->
					</div>
					<form class="messaging-form mb-0" v-on:submit="submit">
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

				if (!this.currentConversationId) {
					this.joinChatRoom(withUserIds, conversationId);
				}
			});

			this.socketOn('Chat', (obj) => {
				obj.author = this.getUserInfo(obj.authorId);
				this.chatLog.push(obj);
			});
		},

		updated() {
			$(this.$refs.bsSelect).selectpicker('refresh');
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

			createChatRoom() {
				var bsSelect = $(this.$refs.bsSelect),
					userIds = bsSelect.selectpicker('val');
				
				bsSelect.selectpicker('val', []);
				this.joinChatRoom(userIds);
			},

			joinChatRoom(userIds, conversationId = 0) {
				this.currentConversationId = conversationId;
				this.chatLog = [];
				this.socketSend('JoinChatRoom', { withUserIds: userIds });
			},

			getMessageClasses(chat) {
				return {
					[chat.authorId == this.currentUserId ? 'me' : 'them']: true
				}
			},

			getUserInfo(userId) {
				return userId == this.currentUserId
					? this.currentUser
					: this.userList[userId];
			},

			getUserName(userId, field = 'fullName') {
				return this.getUserInfo(userId)[field];
			},

			getUserListClasses(user) {
				return {
					online: user.online
				};
			},

			isUserOnline(userId) {
				return this.connectedUsers.includes(userId);
			},

			getContactIcon(user) {
				var classes = ['fas', 'fa-circle'];
				if (user.online) {
					classes.push('online');
				}

				return classes.join(' ');
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
		border-top: 1px solid #ddd;
	}
	.user-row:first-child {
		border: none;
	}

	.user-row:nth-child(even) {
		background-color: #f0f0f0;
	}

	.user-row .user-item {
		padding: 0px 4px;
	}
	
	.user-row:hover,
	.user-row.selected {
		background-color: #faa;
	}

	.message-log {
		min-height: 475px;
		max-height: 600px;
		overflow-y: scroll;
	}

	/* .message-log .item.me {
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
	} */

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

	.selectpicker ::v-deep ~ * .fa-circle,
	.user-list .fa-circle {
		color: red;
	}

	.selectpicker ::v-deep ~ * .fa-circle.online,
	.user-list .fa-circle.online {
		color: green;
	}
	
</style>