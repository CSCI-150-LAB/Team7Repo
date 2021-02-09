<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSockets_App implements MessageComponentInterface {
	public static $instance = null;

	/** @var \Ratchet\Server\IoServer */
	protected $server;
	protected $di;

	protected $clients;

    public function __construct() {
		$this->setupDI();

		$this->server = IoServer::factory(
			new HttpServer(
				new WsServer(
					$this
				)
			),
			$_ENV['socketPort']
		);

		$this->clients = new \SplObjectStorage;
		
		$filePath = APP_ROOT . '/shutdown_websocket_server.txt';
		$this->server->loop->addPeriodicTimer(30, function() use ($filePath) {
			if (file_exists($filePath)) {
				unlink($filePath);
				$this->server->loop->stop();
			}
		});
	}

	private function setupDI() {
		// This really isn't all that good
		$this->di = DI::getDefault();
		$this->di->clearAll();

		// duplicate to what is in index.php
		$this->di->addTransient('Db', function() {
			return new Db($_ENV['dbhost'], $_ENV['dbuser'], $_ENV['dbpass'], $_ENV['dbname']);
		});
	}

    public function onOpen(ConnectionInterface $conn) {
		// Store the new connection to send messages to later
		$this->clients[$conn] = new WebSockets_Client($this->server->loop, $conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
		$payload = json_decode($msg, true);
		$client = $this->clients[$from];

		switch ($payload['type']) {
			case 'auth':
				break;

			case 'sub':
				break;

			case 'unsub':
				break;

			default:
				$client->send(new WebSockets_Packet_InvalidFrame());
				break;
		}
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        unset($this->clients[$conn]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
	}

	public function run() {
		$this->server->run();
	}
	
	public static function start() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
			self::$instance->run();
		}
	}
}