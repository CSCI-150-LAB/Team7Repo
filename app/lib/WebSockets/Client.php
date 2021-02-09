<?php

use Ratchet\ConnectionInterface;
use React\EventLoop\LoopInterface;

class WebSockets_Client {
	private $loop;
	private $conn;
	private $user;

	public function __construct(LoopInterface $loop, ConnectionInterface $conn) {
		$this->loop = $loop;
		$this->conn = $conn;

		$this->loop->addTimer(5, function() {
			if (!$this->isAuthenticated()) {
				$this->closeConnection();
			}
		});
	}

	public function isAuthenticated() {
		return !is_null($this->user);
	}

	public function authenticate($email, $token) {
		throw new Exception('Not Implemented');
	}

	public function closeConnection() {
		$this->conn->close();
	}

	public function sendPacket(WebSockets_Packet_Abstract $packet) {
		$this->conn->send($packet->output());
	}
}