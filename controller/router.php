<?php

class router
{
	private $url;
	public function __construct($url){
		$this->url=$url;
	}

	public function run()
	{
		$data = explode('/',$this->url);
		$controller = $data[0].'Controller';
		$method = $data[1];
		$params = null;
		if (isset($data[2])) {
			$params = $data[2];
		}
		require_once('controller/'.$controller.'.php');
		$ctrl = new $controller;
		$ctrl->$method($params);
	}
}





 ?>