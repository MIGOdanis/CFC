<?php

/**
 * This is the model class for table "{{message}}".
 *
 * The followings are the available columns in table '{{message}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $target
 * @property integer $publish_id
 * @property integer $active
 * @property integer $active_time
 * @property integer $creat_time
 */
class Message extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, target, publish_id, active, active_time, creat_time, type', 'required', 'message'=>'{attribute}為必填'),
			array('publish_id, active, active_time, creat_time', 'numerical', 'integerOnly'=>true),
			array('title, target', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, content, target, publish_id, active, active_time, creat_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::HAS_ONE, 'User', array('id'=>'publish_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '標題',
			'content' => '內文',
			'target' => '發布對象',
			'publish_id' => '發布者',
			'active' => '啟用狀態',
			'active_time' => '顯示日期',
			'creat_time' => '發布時間',
			'type' => '發布平台'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.title',$this->title,true);
		$criteria->compare('t.content',$this->content,true);
		$criteria->compare('t.target',$this->target,true);
		$criteria->compare('t.publish_id',$this->publish_id);
		$criteria->compare('t.active',$this->active);
		$criteria->compare('t.active_time',$this->active_time);
		$criteria->compare('t.creat_time',$this->creat_time);
		$criteria->with = array("user");

		return new CActiveDataProvider($this, array(
			'pagination' => array(
				'pageSize' => 50
			),
			'sort' => array(
				'defaultOrder' => 't.id DESC',
			),
			'criteria'=>$criteria,
		));
	}

	public function getMsg($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		//$criteria->addCondition("id = ".(int)$id);
		$criteria->with = array("user");
		return $this->findByPk($id);
	}

	public function getMsgByTarget($target)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;
		$criteria->addCondition("t.target LIKE '%". $target ."%'");
		$criteria->addCondition("t.active_time < " . time());
		$criteria->addCondition("t.active = 1");
		$criteria->addCondition("t.type = 1 OR t.type = " . (int)$_GET['type']);
		$criteria->with = array("user");

		return new CActiveDataProvider($this, array(
			'pagination' => array(
				'pageSize' => 50
			),
			'sort' => array(
				'defaultOrder' => 't.id DESC',
			),
			'criteria'=>$criteria,
		));
	}

	public function getMsgByTargetAndId($target,$id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;
		$criteria->addCondition("t.target LIKE '%". $target ."%'");
		$criteria->addCondition("t.id =" . $id);
		$criteria->addCondition("t.active_time < " . time());
		$criteria->addCondition("t.active = 1");
		$criteria->with = array("user");
		
		return $this->find($criteria);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Message the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
