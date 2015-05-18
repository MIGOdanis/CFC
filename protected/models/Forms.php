<?php

/**
 * This is the model class for table "{{forms}}".
 *
 * The followings are the available columns in table '{{forms}}':
 * @property integer $id
 * @property string $title
 * @property string $caption
 * @property integer $progress
 * @property string $question
 * @property integer $active
 * @property integer $creat_time
 * @property integer $fill_count
 * @property integer $star_time
 * @property integer $end_time
 * @property integer $creat_by
 * @property string $over_content
 */
class Forms extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{forms}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question, active, creat_time, fill_count, star_time, end_time, creat_by', 'required'),
			array('progress, active, creat_time, fill_count, star_time, end_time, creat_by', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('over_content,head_code', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, caption, progress, question, active, creat_time, fill_count, star_time, end_time, creat_by, over_content', 'safe', 'on'=>'search'),
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
			'user' => array(self::HAS_ONE, 'User', array('id'=>'creat_by')),
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
			'caption' => '說明',
			'progress' => '顯示進度',
			'question' => '問題',
			'active' => '啟用狀態',
			'creat_time' => '建立時間',
			'fill_count' => '填表數量',
			'star_time' => '開始時間',
			'end_time' => '結束時間',
			'creat_by' => '建立者',
			'over_content' => '完成內容',
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
		$user = User::model()->findByPk(Yii::app()->user->id);


		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('caption',$this->caption,true);
		$criteria->compare('progress',$this->progress);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('creat_time',$this->creat_time);
		$criteria->compare('fill_count',$this->fill_count);
		$criteria->compare('star_time',$this->star_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('creat_by',$this->creat_by);
		$criteria->compare('over_content',$this->over_content,true);
		$criteria->with = 'user';

		if($user->group != 1)
			$criteria->addCondition("user.group = " . $user->group);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Forms the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
