<?php

class WebSockets_Message_Chat extends WebSockets_Message_Abstract {
	public $authorId;
	public $conversationId;
	public $message;
	public $read;
	public $createdAt;
}