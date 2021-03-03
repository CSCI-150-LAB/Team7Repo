<?php

interface WebSockets_IApp {
	function onUserConnect(WebSockets_User $user);
	function onUserDisconnect(WebSockets_User $user);
	function onUserAuthChanged(WebSockets_User $user);
	function onMessage(WebSockets_User $user, WebSockets_Message_Abstract $data);
}