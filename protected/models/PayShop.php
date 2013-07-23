<?php

/**
 * This is the model class for table "pay_shop".
 *
 * The followings are the available columns in table 'pay_shop':
 * @property string $id
 * @property string $type
 * @property string $pic
 * @property string $item_name
 * @property string $description
 * @property double $price
 * @property integer $status
 */
class PayShop extends CActiveRecord
{
        public $count=1;
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PayShop the static model class
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
		return 'pay_shop';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('id', 'length', 'max'=>11),
			array('type', 'length', 'max'=>20),
			array('pic, description', 'length', 'max'=>250),
			array('item_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, pic, item_name, description, price, status', 'safe', 'on'=>'search'),
                        array('count', 'numerical', 'integerOnly'=>true),
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
			'type' => 'Тип',
			'pic' => 'Картинка',
			'item_name' => 'Название',
			'description' => 'Описание',
			'price' => 'Цена',
			'status' => 'Статус',
                        'count' => 'Количество',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('item_name',$this->item_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getItemPrice($id)
        {
            $model=  self::model()->findByPk($id);
            return $model->price;
        }

        public function updateBalance($id, $login, $count)
        {
            $price=  self::model()->getItemPrice($id);
            $balance = PayBalance::model()->find('login=:login', array(':login'=>$login));
            $price=$price*$count;
            $balance->balance=$balance->balance-$price;
            $balance->saveAttributes(array('balance'));
        }
        
        public function checkBalance($id, $login, $count)
        {
            $price=  self::model()->getItemPrice($id);  
            $balance = PayBalance::model()->find('login=:login', array(':login'=>$login));
            if($balance->balance<$price*$count){
                return false;
            } else
            {
                return true;
            }
        }
        
        public function buyItem($id, $char_id, $count)
        {
            $shop = self::model()->findByPk($id);
            $stackable= ($shop->type=='stackable') ? true : false;

            $player = Characters::model()->find('obj_Id=:obj_Id', array(':obj_Id'=>$char_id));
            $balance = PayBalance::model()->find('login=:login', array(':login'=>$player->account_name));
            $price=$shop->price*$count;
            if($balance->balance<$price){
                return false;
            } else
            {
                Items::model()->addItem($char_id, $id, $count, $stackable);
                $balance->balance=$balance->balance-$price;
                $balance->saveAttributes(array('balance'));
                Transactions::model()->addTransaction($player->account_name, $player->char_name, $shop->id, $shop->item_name, $count, $shop->price);
                return true;
            }
        }
        
        public function getLink($data, $char_id)
        {
            if ($data->type=='stackable') {
                
            }
            return CHtml::beginForm() . 
                   CHtml::textField("count", $data->count, array("class"=>"span1", "maxlength"=>4)) . 
                   CHtml::linkButton(' Купить',array(
                          'submit'=>Yii::app()->controller->createUrl("add",array("id"=>$data->primaryKey,"char"=>$char_id)),
                          'confirm'=>"Вы уверены, что хотите купить данный итем?")).
                   CHtml::endForm();
        }

}