<?php
class FormWidget extends CWidget
{
	public $object;
	public $update;
	public $page;

	public function init()
	{
		$this->page = array(
			"singleText" => "_singleText",
			"multiText" => "_multiText",
			"singleSelect" => "_singleSelect",
			"multiSelect" => "_multiSelect",
			"dropDown" => "_dropDown",
			"numberToLevel" => "_numberToLevel",
			"tableSelect" => "_tableSelect",
			"dateAndTime" => "_dateAndTime",
			"html" => "_html"
		);		

	}
	
	public function run()
	{   
		if(isset($this->object->display) && $this->object->display != 0){
			$this->render($this->page[$this->object->type], array('object' => $this->object, "update" => $this->update));			
		}
	
	}
}
