<?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $object_id
 * @property integer $owner_id
 * @property integer $item_id
 * @property string $count
 * @property integer $enchant_level
 * @property string $loc
 * @property integer $loc_data
 * @property integer $life_time
 * @property integer $augmentation_id
 * @property integer $attribute_fire
 * @property integer $attribute_water
 * @property integer $attribute_wind
 * @property integer $attribute_earth
 * @property integer $attribute_holy
 * @property integer $attribute_unholy
 * @property integer $custom_type1
 * @property integer $custom_type2
 * @property integer $custom_flags
 * @property integer $agathion_energy
 */
class Items extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Items the static model class
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
		return 'items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('object_id, owner_id, item_id, count, enchant_level, loc, loc_data, life_time, augmentation_id, attribute_fire, attribute_water, attribute_wind, attribute_earth, attribute_holy, attribute_unholy, custom_type1, custom_type2, custom_flags, agathion_energy', 'required'),
			array('object_id, owner_id, item_id, enchant_level, loc_data, life_time, augmentation_id, attribute_fire, attribute_water, attribute_wind, attribute_earth, attribute_holy, attribute_unholy, custom_type1, custom_type2, custom_flags, agathion_energy', 'numerical', 'integerOnly'=>true),
			array('count', 'length', 'max'=>20),
			array('loc', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('object_id, owner_id, item_id, count, enchant_level, loc, loc_data, life_time, augmentation_id, attribute_fire, attribute_water, attribute_wind, attribute_earth, attribute_holy, attribute_unholy, custom_type1, custom_type2, custom_flags, agathion_energy', 'safe', 'on'=>'search'),
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
			'object_id' => 'Object',
			'owner_id' => 'Owner',
			'item_id' => 'Item',
			'count' => 'Count',
			'enchant_level' => 'Enchant Level',
			'loc' => 'Loc',
			'loc_data' => 'Loc Data',
			'life_time' => 'Life Time',
			'augmentation_id' => 'Augmentation',
			'attribute_fire' => 'Attribute Fire',
			'attribute_water' => 'Attribute Water',
			'attribute_wind' => 'Attribute Wind',
			'attribute_earth' => 'Attribute Earth',
			'attribute_holy' => 'Attribute Holy',
			'attribute_unholy' => 'Attribute Unholy',
			'custom_type1' => 'Custom Type1',
			'custom_type2' => 'Custom Type2',
			'custom_flags' => 'Custom Flags',
			'agathion_energy' => 'Agathion Energy',
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

		$criteria->compare('object_id',$this->object_id);
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('count',$this->count,true);
		$criteria->compare('enchant_level',$this->enchant_level);
		$criteria->compare('loc',$this->loc,true);
		$criteria->compare('loc_data',$this->loc_data);
		$criteria->compare('life_time',$this->life_time);
		$criteria->compare('augmentation_id',$this->augmentation_id);
		$criteria->compare('attribute_fire',$this->attribute_fire);
		$criteria->compare('attribute_water',$this->attribute_water);
		$criteria->compare('attribute_wind',$this->attribute_wind);
		$criteria->compare('attribute_earth',$this->attribute_earth);
		$criteria->compare('attribute_holy',$this->attribute_holy);
		$criteria->compare('attribute_unholy',$this->attribute_unholy);
		$criteria->compare('custom_type1',$this->custom_type1);
		$criteria->compare('custom_type2',$this->custom_type2);
		$criteria->compare('custom_flags',$this->custom_flags);
		$criteria->compare('agathion_energy',$this->agathion_energy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function addItem($char_id, $item_id, $count) {
           
        $result = Items::model()->findByAttributes(array('item_id' => $item_id, 'owner_id' => $char_id));
           if ($result !== NULL && $count>1) {
                $result->count = $result->count+$count; 
            if ($model->save(false)) {
             }
           } else {
               $model = new Items;
               $object_id = Items::model()->findBySql('SELECT MAX(object_id) FROM items');
               $model->object_id = $object_id;
               if ($model->save(false)) {
                }
           }
        
        }
        
}