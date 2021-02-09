<?php



class WebSockets_Helpers {
	private function __construct() {}

	public static function closeBrowserConnection() {
		// Close client connection
		ignore_user_abort(true);
		$size = ob_get_length();
		header("Content-Encoding: none");
		header("Content-Length: {$size}");
		header("Connection: close");
		ob_end_flush();
		@ob_flush();
		flush();
		
		if (session_id()) {
			session_write_close();
		}
	}

	public static function isRunning() {
		$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_set_option($sock, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 0, 'usec' => 500000));
		socket_set_option($sock, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 0, 'usec' => 500000));

		$result = @socket_connect($sock, '127.0.0.1', 8080);
		socket_close($sock);

		return $result;
	}
}