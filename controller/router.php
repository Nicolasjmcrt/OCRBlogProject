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
	
		if (! isset($data[0]) || empty ($data[0])) {
			$controller = 'homeController';
		} else {
			$controller = $data[0].'Controller';
		}
		
		if (! isset($data[1]) || empty ($data[1])) {
			$method = 'list';
		}
		else {
		$method = $data[1];
		}
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