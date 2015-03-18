<?php

/**
 * This is the model class for table "{{forms_ans}}".
 *
 * The followings are the available columns in table '{{forms_ans}}':
 * @property integer $id
 * @property string $ans
 * @property integer $form_id
 * @property integer $user_id
 * @property integer $creat_time
 */
class FormsAns extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{forms_ans}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ans, form_id, user_id, creat_time', 'required'),
			array('form_id, user_id, creat_time', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ans, form_id, user_id, creat_time', 'safe', 'on'=>'search'),
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
			'formUser' => array(self::HAS_ONE, 'FormsUser', array('id'=>'user_id')),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ans' => 'Ans',
			'form_id' => 'Form',
			'user_id' => 'User',
			'creat_time' => 'Creat Time',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('ans',$this->ans,true);
		$criteria->compare('form_id',$this->form_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('creat_time',$this->creat_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FormsAns the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
