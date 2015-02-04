<?php
class NaviWidget extends CWidget
{
	public $item;
	public $controller;
	public $ignoreController;

	public function init()
	{

	}
	
	public function run()
	{   
		$this->render('naviWidget', array('item' => $this->item , 'ignoreController' => $this->ignoreController, "controller" => $this->controller));
	}
}
