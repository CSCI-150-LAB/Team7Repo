window.SocketHandler = (function() {
	var conn = null,
		events = {},
		result = {};

	function on(evt, fn) {
		if (!events[evt]) {
			events[evt] = [];
		}

		events[evt].push(fn);
	}

	function off(evt, fn) {
		if (events[evt]) {
			var ndx = events[evt].indexOf(fn);
			if (ndx >= 0) {
				events[evt].splice(ndx, 1);
			}
		}
	}

	function send(type, data) {
		var message = {
			type: type
		};

		if (typeof data == 'object') {
			message.data = data;
		}

		conn.send(JSON.stringify(message));
	}

	function trigger(evt) {
		if (events[evt]) {
			var params = Array.prototype.slice.call(arguments, 1);
			events[evt].forEach(fn => fn(...params));
		}
	}

	function connectToServer() {
		conn = new WebSocket(`ws://${location.hostname}:8080`);

		conn.onopen = function(e) {
			trigger('_connect');
		};

		conn.onclose = function() {
			trigger('_disconnect');
		};

		conn.onmessage = function(e) {
			try {
				var msg = JSON.parse(e.data);

				if (msg && msg.type) {
					trigger('_message', msg);
					trigger(msg.type, msg.data);
				}
			}
			catch (e) {
				console.error(e);
			}
		};

		conn.onerror = function(e) {
			setTimeout(connectToServer, 15);
		};
	}

	// Authenticate
	on('_connect', function() {
		result.status = 'connected';

		send('Auth', {
			userId: AUTH_INFO.userId,
			userToken: AUTH_INFO.authToken
		});
	});

	on('_disconnect', () => result.status = 'disconnected');

	on('UserStatus', function(status) {
		if (result.loggedIn = status.userId > 0) {
			trigger('_authenticated');
		}
	});

	if (AUTH_INFO) {
		connectToServer();
	}

	Object.assign(result, {
		_trigger: trigger,
		_conn: conn,
		loggedIn: false,
		on: on,
		off: off,
		send: send,
		status: 'disconnected',
		ready: function(fn) {
			if (!conn || conn.readyState != 1) {
				on('_connect', fn);
			}
			else {
				fn();
			}
		},
		getVueMixin: function() {
			return {
				data() {
					return {
						websockets_loggedIn: result.loggedIn,
						websockets_status: result.status
					};
				},

				computed: {
					isSocketConnected() {
						return this.websockets_status == 'connected';
					},
					isSocketUserAuthenticated() {
						return this.websockets_loggedIn;
					}
				},

				created() {
					this._websocket_handlers = [
						{evt: '_connect', fn: () => this.websockets_status = 'connected'},
						{evt: '_disconnect', fn: () => this.websockets_status = 'disconnected'},
						{evt: '_authenticated', fn: () => this.websockets_loggedIn = true}
					];

					this._websocket_handlers.forEach(({ evt, fn }) => on(evt, fn));
				},

				destroyed() {
					this._websocket_handlers.forEach(({ evt, fn }) => off(evt, fn));
				},

				methods: {
					socketOn(evt, fn) {
						this._websocket_handlers.push({
							evt,
							fn
						});
						on(evt, fn);
					},

					socketOff(evt, fn) {
						for (let i = 0; i < this._websocket_handlers.length; i++) {
							if (this._websocket_handlers[i].evt == evt && this._websocket_handlers[i].fn === fn) {
								this._websocket_handlers.splice(i, 1);
								break;
							}
						}
					},

					socketSend(type, data) {
						result.send(type, data);
					}
				}
			};
		}
	});

	return result;
})();