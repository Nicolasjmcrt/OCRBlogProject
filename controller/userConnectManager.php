<?php


class userConnectManager
{
	public function login()
	{
		print_r($_POST);
		require_once('login.php');

	}

	public function logout()
	{
		echo 'logout';
	}

	public function register()
	{
		echo 'register';
	}
}



 ?>