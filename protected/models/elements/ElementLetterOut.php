<?php
/*
_____________________________________________________________________________
(C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
(C) OpenEyes Foundation, 2011
This file is part of OpenEyes.
OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
_____________________________________________________________________________
http://www.openeyes.org.uk   info@openeyes.org.uk
--
*/

/**
 * This is the model class for table "element_letterout".
 *
 * The followings are the available columns in table 'element_letterout':
 * @property string $id
 * @property string $event_id
 * @property string $value
 */
class ElementLetterOut extends BaseElement
{
	public $service;

	/**
	 * Returns the static model of the specified AR class.
	 * @return ElementLetterOut the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'element_letterout';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value, event_id, from_address, date, dear, re, to_address, cc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, from_address, date, dear, re, value, to_address, cc', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('strings','ID'),
			'event_id' => Yii::t('strings','Event'),
			'from_address' => Yii::t('strings','From'),
			'date' => Yii::t('strings','Date'),
			'dear' => Yii::t('strings','Dear...'),
			're' => Yii::t('strings','RE'),
			'value' => Yii::t('strings','Text'),
			'to_address' => Yii::t('strings','To'),
			Yii::t('strings','cc') => Yii::t('strings','cc')
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('event_id',$this->event_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function getService()
	{
		if (empty($this->service)) {
			$this->service = new LetterOutService($this->firm);
		}

		return $this->service;
	}

	public function getPhrase($name)
	{
		return $this->getService()->getPhrase('LetterOut', $name);
	}
}
