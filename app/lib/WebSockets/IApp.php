<?php

interface WebSockets_IApp {
	function onUserConnect(WebSockets_User $user);
	function onUserDisconnect(WebSockets_User $user);
	function onMessage(WebSockets_User $user, $data);
}