<?php
class CountMessageWidget extends CWidget
{
	public $type;
	private $_model;

	public function init()
	{
		$criteria=new CDbCriteria;

		if($this->type != "all")
			$criteria->addCondition("type = '" . $this->type ."'");

		$criteria->addCondition("status = 1");
		$this->_model = Message::model()->count($criteria);
	}
	
	public function run()
	{   
		$this->render('countMessageWidget', array('count' => $this->_model));
	}
}
