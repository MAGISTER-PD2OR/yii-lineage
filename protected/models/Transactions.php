<?php

/**
 * This is the model class for table "transactions".
 *
 * The followings are the available columns in table 'transactions':
 * @property string $id
 * @property string $ip
 * @property string $login
 * @property string $char_name
 * @property string $item_type
 * @property string $item_name
 * @property integer $count
 * @property double $price_one
 * @property double $price_final
 * @property string $trans_date
 */
class Transactions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Transactions the static model class
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
		return 'pay_transactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip, login, char_name, item_type, item_name, count, price_one, price_final', 'required'),
			array('count, trans_date', 'numerical', 'integerOnly'=>true),
			array('price_one, price_final', 'numerical'),
			array('ip', 'length', 'max'=>250),
			array('login, char_name, item_type, item_name', 'length', 'max'=>50),
			array('id, ip, login, char_name, item_type, item_name, count, price_one, price_final, trans_date', 'safe', 'on'=>'search'),
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
			'ip' => 'IP',
			'login' => 'Логин',
			'char_name' => 'Персонаж',
			'item_type' => 'Тип',
			'item_name' => 'Название',
			'count' => 'Количество',
			'price_one' => 'Цена',
			'price_final' => 'Итого',
			'trans_date' => 'Дата',
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
		$criteria->compare('ip',$this->ip,true);
                if (Yii::app()->user->name==Yii::app()->params['adminName']){
		$criteria->compare('login',$this->login,true);  
                } else {
                $criteria->compare('login',  Yii::app()->user->name);
                }
		$criteria->compare('char_name',$this->char_name,true);
		$criteria->compare('item_type',$this->item_type,true);
		$criteria->compare('item_name',$this->item_name,true);
		$criteria->compare('count',$this->count);
		$criteria->compare('price_one',$this->price_one);
		$criteria->compare('price_final',$this->price_final);
		$criteria->compare('trans_date',$this->trans_date,true);
                $criteria->order='trans_date DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getBalanse($login)
        {
            $balance = Yii::app()->db->createCommand()
                    ->select('balance')
                    ->from('pay_balance')
                    ->where('login=:login', array(':login'=>$login))
                    ->queryRow();
            return $balance['balance'];
        }
        
        public function setBalance($login,$summ)
        {
            $balance = $this->getBalanse($login);
            $command = Yii::app()->db->createCommand();
            if(!empty($balance)){
              $summ=$summ+$balance;
              $command->update('pay_balance', array(
                                'balance' => $summ), 
                                'login=:login', array(':login'=>$login));
            } else
            {
              $command->insert('pay_balance', array(
                                'login' => $login,
                                'balance' => $summ,));
            }
        }
        
        public function logTransactions($fio, $summ)
        {
        $command = Yii::app()->db->createCommand();
        $command->insert('pay_transactions', array(
            'ip' => Yii::app()->request->getUserHostAddress(),
            'login' => $fio,
            'count' => 1,
            'price_one' => $summ,
            'item_name' => 'Пополнение баланса',
            'trans_date' => time(),
        ));
        return Yii::app()->db->getLastInsertID();;
        }
        
        public function logTransactionsOk($outSum, $invId)
        {
            $command = Yii::app()->db->createCommand();
            $command->update('pay_transactions', array(
                'price_final' => $outSum,
                    ), 'id=:id', array(':id' => $invId));
            $login = Yii::app()->db->createCommand()
                    ->select('login')
                    ->from('pay_transactions')
                    ->where('id=:id', array(':id' => $invId))
                    ->queryRow();
            self::model()->setBalance($login['login'], $outSum);
        }
        
        public function addTransaction($login, $char_name, $item_type, $item_name, $count, $price_one)
        {
            $model=new Transactions;
            $model->ip=Yii::app()->request->getUserHostAddress();
            $model->login=$login;
            $model->char_name=$char_name;
            $model->item_type=$item_type;
            $model->item_name=$item_name;
            $model->count=$count;
            $model->price_one=$price_one;
            $model->price_final=$model->count*$model->price_one;        
            $model->trans_date=time();
            $model->save(false);
        }
        
        public function addTransactionExchange($login, $count, $price_one, $price)
        {
            $model=new Transactions;
            $model->ip=Yii::app()->request->getUserHostAddress();
            $model->login=$login;
            $model->item_name='Обмен валют';
            $model->count=$count;
            $model->price_one=$price_one;
            $model->price_final=$price;        
            $model->trans_date=time();
            $model->save(false);
        }
        
}