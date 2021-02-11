<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\TimerInterface;

class WebSockets_Server {
	/** @var \Ratchet\Server\IoServer */
	protected $rawServer;

	public function __construct($serverApp, $port) {
		$this->rawServer = IoServer::factory(
			new HttpServer(
				new WsServer(
					$serverApp
				)
			),
			$port
		);
	}

	public function addPeriodicTimer(callable $fn, $interval) {
		return $this->rawServer->loop->addPeriodicTimer($interval, $fn);
	}

	public function addTimer(callable $fn, $delay) {
		return $this->rawServer->loop->addTimer($delay, $fn);
	}

	public function cancelTimer(TimerInterface $timer) {
		$this->rawServer->loop->cancelTimer($timer);
	}

	public function start() {
		$this->rawServer->run();
	}

	public function stop() {
		if ($this->rawServer instanceof IoServer) {
			$this->rawServer->loop->stop();
			$this->rawServer = null;
		}
	}
}