<?php
class MenuWidget extends CWidget
{
	public $item;
	public $action;
	public $controller;

	public function init()
	{

	}
	
	public function run()
	{   
		$this->render('menuWidget', array('item' => $this->item , 'action' => $this->action, "controller" => $this->controller));
	}
}
