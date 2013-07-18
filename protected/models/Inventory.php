<?php

/**
 * This is the model class for table "inventory".
 *
 * The followings are the available columns in table 'inventory':
 * @property integer $itemUniqueId
 * @property integer $itemId
 * @property string $itemCount
 * @property integer $itemColor
 * @property integer $itemOwner
 * @property string $itemCreator
 * @property string $itemCreationTime
 * @property string $itemExistTime
 * @property integer $itemTradeTime
 * @property integer $isEquiped
 * @property integer $isSoulBound
 * @property integer $slot
 * @property integer $itemLocation
 * @property integer $enchant
 * @property integer $itemSkin
 * @property integer $fusionedItem
 * @property integer $optionalSocket
 * @property integer $optionalFusionSocket
 * @property integer $charge
 * @property integer $sealStats
 * @property string $sealEndTime
 */
class Inventory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Inventory the static model class
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
		return 'inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('itemUniqueId, itemId, itemOwner, itemCreator', 'required'),
			array('itemUniqueId, itemId, itemColor, itemOwner, itemTradeTime, isEquiped, isSoulBound, slot, itemLocation, enchant, itemSkin, fusionedItem, optionalSocket, optionalFusionSocket, charge, sealStats', 'numerical', 'integerOnly'=>true),
			array('itemCount, itemExistTime, sealEndTime', 'length', 'max'=>20),
			array('itemCreator', 'length', 'max'=>50),
			array('itemCreationTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('itemUniqueId, itemId, itemCount, itemColor, itemOwner, itemCreator, itemCreationTime, itemExistTime, itemTradeTime, isEquiped, isSoulBound, slot, itemLocation, enchant, itemSkin, fusionedItem, optionalSocket, optionalFusionSocket, charge, sealStats, sealEndTime', 'safe', 'on'=>'search'),
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
			'itemUniqueId' => 'Item Unique',
			'itemId' => 'Item',
			'itemCount' => 'Item Count',
			'itemColor' => 'Item Color',
			'itemOwner' => 'Item Owner',
			'itemCreator' => 'Item Creator',
			'itemCreationTime' => 'Item Creation Time',
			'itemExistTime' => 'Item Exist Time',
			'itemTradeTime' => 'Item Trade Time',
			'isEquiped' => 'Is Equiped',
			'isSoulBound' => 'Is Soul Bound',
			'slot' => 'Slot',
			'itemLocation' => 'Item Location',
			'enchant' => 'Enchant',
			'itemSkin' => 'Item Skin',
			'fusionedItem' => 'Fusioned Item',
			'optionalSocket' => 'Optional Socket',
			'optionalFusionSocket' => 'Optional Fusion Socket',
			'charge' => 'Charge',
			'sealStats' => 'Seal Stats',
			'sealEndTime' => 'Seal End Time',
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

		$criteria->compare('itemUniqueId',$this->itemUniqueId);
		$criteria->compare('itemId',$this->itemId);
		$criteria->compare('itemCount',$this->itemCount,true);
		$criteria->compare('itemColor',$this->itemColor);
		$criteria->compare('itemOwner',$this->itemOwner);
		$criteria->compare('itemCreator',$this->itemCreator,true);
		$criteria->compare('itemCreationTime',$this->itemCreationTime,true);
		$criteria->compare('itemExistTime',$this->itemExistTime,true);
		$criteria->compare('itemTradeTime',$this->itemTradeTime);
		$criteria->compare('isEquiped',$this->isEquiped);
		$criteria->compare('isSoulBound',$this->isSoulBound);
		$criteria->compare('slot',$this->slot);
		$criteria->compare('itemLocation',$this->itemLocation);
		$criteria->compare('enchant',$this->enchant);
		$criteria->compare('itemSkin',$this->itemSkin);
		$criteria->compare('fusionedItem',$this->fusionedItem);
		$criteria->compare('optionalSocket',$this->optionalSocket);
		$criteria->compare('optionalFusionSocket',$this->optionalFusionSocket);
		$criteria->compare('charge',$this->charge);
		$criteria->compare('sealStats',$this->sealStats);
		$criteria->compare('sealEndTime',$this->sealEndTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function addItem($char_id, $item_id, $count) {
        
	$res="SELECT * FROM inventory WHERE itemOwner='$char_id' AND itemId='$item_id' LIMIT 1";  
        $max="SELECT max(itemUniqueId)+1 as maxid FROM inventory";
        $connection=Yii::app()->db;
        $row = $connection->createCommand($res)->queryRow();
        $row2 = $connection->createCommand($max)->queryRow();
        $itemUniqueId = $row2['maxid'];
        $update_query="UPDATE inventory SET itemCount=itemCount+$count WHERE itemOwner='$char_id' AND itemId='$item_id' LIMIT 1";
	$insert_query="INSERT INTO inventory (itemUniqueId,itemCount,itemOwner,itemId) VALUES($itemUniqueId,$count,$char_id,'$item_id')";
        
        if ($count > 1) {     
        // есть чО?      
        if ($row) { 
        // чОтО есть  
          $connection->createCommand($update_query)->execute();
        }  else {   
        // нет никуя
          $connection->createCommand($insert_query)->execute();
        }
        // даём без проверок						
        } else {
          $connection->createCommand($insert_query)->execute(); 
        }
        
        }
}