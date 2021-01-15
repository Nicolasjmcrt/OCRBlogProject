<?php

require_once('model/User.php');

function listUsers() {
	$user = new User();
	$users = $user->getUsers();

	require('view/listUsers.php');
}