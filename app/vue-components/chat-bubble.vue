<template>
	<div class="bubble-container" v-bind:class="chat.authorId == currentUserId ? 'me' : 'them'">
		<div class="chat-bubble" v-bind:class="timeVisible && previousChat ? 'mt-2' : ''" v-on="getEvents()">
			<div v-if="timeVisible" class="time">{{chat.createdAt}}</div>
			<div v-if="showAuthor" class="author">
				<img v-bind:src="publicUrl('images/blank_avatar.png')">
				{{chat.author.fullName}}
			</div>
			<div class="message">
				{{chat.message}}
			</div>
		</div>
	</div>
</template>

<script>
	// 10 minutes
	const TIME_SHOW_CUTOFF = 10 * 60 * 1000;

	export default {
		mixins: [SocketHandler.getVueMixin(), VueMixin],
		
		props: {
			chat: {
				type: Object,
				required: true
			},
			previousChat: {
				type: Object,
				required: false
			}
		},

		data() {
			return {
				timeVisible: false
			}
		},

		computed: {
			showTimeString() {
				if (!this.previousChat) {
					return true;
				}

				let prev = Date.parse(this.previousChat.createdAt),
					curr = Date.parse(this.chat.createdAt);

				return curr - prev > TIME_SHOW_CUTOFF;
			},
			showAuthor() {
				if (!this.previousChat) {
					return true;
				}

				return this.showTimeString || this.previousChat.authorId != this.chat.authorId;
			}
		},

		methods: {
			getEvents() {
				let result = {};

				if (!this.showTimeString) {
					result.click = () => this.timeVisible = !this.timeVisible;
				}

				return result;
			}
		},

		watch: {
			showTimeString: {
				handler(to) {
					this.timeVisible = to;
				},
				immediate: true
			}
		}
	}
</script>

<style>
	.bubble-container.me {
		text-align: right;
	}

	.chat-bubble {
		display: inline-block;
		border-radius: 20px;
		border: 1px solid #8a8a8a;
		padding: 2px 10px;
		max-width: 60%;
		text-align: left;
		margin-bottom: 5px;
	}

	.time {
		color: #ccc;
	}

	.author img {
		max-width: 20px;
		border-radius: 50%;
	}
</style>