<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

//TODO: Remove the MessageComponentInterface from this class and move to hidden delegate class that publishes events to this class
class WebSockets_ServerApp implements MessageComponentInterface {
	/** @var WebSockets_Server */
	protected $users;
	protected $server;
	/** @var WebSockets_IApp[] */
	protected $applications = [];

    public function __construct() {
		$this->users = new SplObjectStorage;
		$this->server = new WebSockets_Server($this, $_ENV['socketPort']);
	}

	public function getServer() {
		return $this->server;
	}

	public function addApplication($class) {
		$di = DI::getDefault();
		$this->applications[] = $di->constructClass($class);
	}

    public function onOpen(ConnectionInterface $conn) {
		$user = new WebSockets_User($conn);
		$this->users[$conn] = $user;

		foreach ($this->applications as $app) {
			$app->onUserConnect($user);
		}
    }

	public function onClose(ConnectionInterface $conn) {
		$user = $this->users[$conn];

		foreach ($this->applications as $app) {
			$app->onUserDisconnect($user);
		}

        unset($this->users[$conn]);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
		$payload = json_decode($msg, true);
		/** @var WebSockets_User */
		$user = $this->users[$from];

		if (!is_array($payload) || !isset($payload['type'])) {
			return;
		}

		$class = 'WebSockets_Message_' . $payload['type'];
		if (class_exists($class)) {
			try {
				$message = new $class(isset($payload['data']) ? $payload['data'] : []);

				foreach ($this->applications as $app) {
					$app->onMessage($user, $message);
				}
			}
			catch (Throwable $e) {
				if (IS_LOCAL) {
					$message = new WebSockets_Message_Error(['msg' => $e->getMessage() . PHP_EOL . $e->getFile() . PHP_EOL . $e->getLine()]);
					$user->send($message);
				}
			}
		}
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
	}

	public function start() {
		$this->server->start();
	}
}