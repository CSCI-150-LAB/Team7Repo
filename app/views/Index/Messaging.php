<?php $users = User::find(); ?>
<div class = "row">
	<div class = "col-4">
	<div class = "card p-4">
  		<div class = "row">
			<div class = "col-8">Recent Messages</div>
			<div class = "col">
				<button type = "button" class="btn btn-secondary" style = "float: right;" data-toggle = "tooltip" data-placement = "right" title = "Start New Conversation">
					<i class = "fas fa-edit"></i>
				</button>
			</div>
		</div>
		<div class = "row">
		<div class = "col" style = "height: 500px; overflow-y: scroll;">
			<?php foreach ($users as $user) : ?>
			<div class = "row">
				<div> <img src="<?php echo $this->publicUrl('images/blank_avatar.png')?>" width="50" height="50" alt="blank_avatar" class="mr-md-4 mb-3 img-fluid"> </div>
				<div> <?php echo($user->firstName . " " . $user->lastName); ?> </div>
			</div>
			<?php endforeach; ?>
		</div>
		</div>
	</div>
	</div>

	<!-- List of messages above, selected message group below -->

	<div class = "col">
	<div class = "card p-4">
		<div id="message-log" style = "height: 475px; overflow-y: scroll;"></div>
		<form class = "messaging-form">
			<div class = "input-group">
				<input type = "text" class = "form-control" id = "message" name = "message" placeholder = "Message">
				<button type = "submit" class = "btn btn-primary"><i class="fas fa-search"></i></button>
			</div>
		</form>
	</div>
  	</div>
</div>

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