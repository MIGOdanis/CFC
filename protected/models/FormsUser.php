<?php

/**
 * This is the model class for table "{{forms_user}}".
 *
 * The followings are the available columns in table '{{forms_user}}':
 * @property integer $id
 * @property string $years
 * @property string $uuid
 * @property string $fb_id
 * @property string $name
 * @property string $phone
 * @property string $mail
 * @property integer $gender
 * @property integer $city
 * @property integer $area
 */
class FormsUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{forms_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('years, phone, mail, name, gender', 'required', 'message'=>'請填入{attribute}'),
			array('gender, city, area', 'numerical', 'integerOnly'=>true),
			array('years, uuid, fb_id', 'length', 'max'=>128),
			array('name, phone, mail', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('years, uuid, fb_id, name, phone, mail, gender, city, area', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'years' => 'Years',
			'uuid' => 'Uuid',
			'fb_id' => 'Fb',
			'name' => 'Name',
			'phone' => 'Phone',
			'mail' => 'Mail',
			'gender' => 'Gender',
			'city' => 'City',
			'area' => 'Area',
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
		$criteria->compare('years',$this->years,true);
		$criteria->compare('uuid',$this->uuid,true);
		$criteria->compare('fb_id',$this->fb_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('city',$this->city);
		$criteria->compare('area',$this->area);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FormsUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
