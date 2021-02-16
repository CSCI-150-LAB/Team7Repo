<form class="messaging-form">
	<div class="form-group">
		<label for="message">Message</label>
		<input type="text" class="form-control" id="message" name="message">
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

<div id="message-log"></div>

<script>
	docReady(function() {
		function log(msg) {
			$('#message-log').append($('<div/>').text(msg));
		}

		var conn = new WebSocket('ws://localhost:8080');
		conn.onopen = function(e) {
			log("Connection established!");
			conn.onclose = function() {
				log('Connection closed');
			};

			conn.send(JSON.stringify({
				type: 'Auth',
				data: {
					userId: 1437,
					userToken: '586e7a3cad98c703103f648bf09cea195a9002d3c61ebc293247d9fea7a96856'	// Hardcoded to me... dumb but for testing
				}
			}));
		};

		conn.onmessage = function(e) {
			try {
				var msg = JSON.parse(e.data);

				switch (msg.type) {
					case 'UserStatus':
						console.log('UserStatus: ', msg);
						if (msg.data.userId) {
							conn.send(JSON.stringify({
								type: 'JoinChatRoom'
							}));
						}
						break;
					case 'Chat':
						log(msg.data.message);
						break;
				}
			}
			catch (e) {
				console.log(e);
			}
		};

		$(document).on('submit', '.messaging-form', function(e) {
			e.preventDefault();

			var msg = $('#message').val();
			$('#message').val('');

			conn.send(JSON.stringify({
				type: 'Chat',
				data: {
					message: msg
				}
			}));
		});
	});
</script>