<?php

/**
 * This is the model class for table "aionshop_transactions".
 *
 * The followings are the available columns in table 'aionshop_transactions':
 * @property string $transaction_id
 * @property integer $server_id
 * @property integer $item_unique_id
 * @property string $buy_timestamp
 * @property string $player_id
 */
class AionshopTransactions extends CActiveRecord
{

    public $player_search;

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'aionshop_transactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('server_id, item_unique_id, buy_timestamp, player_id', 'required'),
			array('server_id, item_unique_id', 'numerical', 'integerOnly'=>true),
			array('buy_timestamp, player_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('transaction_id, server_id, item_unique_id, buy_timestamp, player_id, player_search', 'safe', 'on'=>'search'),
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
                    'player'=>array(self::BELONGS_TO, 'Players', 'player_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'transaction_id' => 'ID',
			'server_id' => 'Server',
			'item_unique_id' => 'Item',
			'buy_timestamp' => 'Buy Time',
			'player_id' => 'PlayerId',
                        'player_search' => 'Player',
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

		$criteria->compare('transaction_id',$this->transaction_id,true);
		$criteria->compare('server_id',$this->server_id);
		$criteria->compare('item_unique_id',$this->item_unique_id);
		$criteria->compare('buy_timestamp',$this->buy_timestamp,true);
		$criteria->compare('player_id',$this->player_id,true);
                $criteria->with = array('player');
                $criteria->compare( 'player.name', $this->player_search, true );
                $criteria->order='transaction_id DESC';
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array('pageSize'=>20),
                        'sort'=>array(
                                'attributes'=>array(
                                'player_search'=>array(
                                'asc'=>'player.name',
                                'desc'=>'player.name DESC',
                            ),
                            '*',
                        ),
                    ),
                ));
	}
}