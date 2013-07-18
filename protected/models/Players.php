<?php

/**
 * This is the model class for table "players".
 *
 * The followings are the available columns in table 'players':
 * @property integer $id
 * @property string $name
 * @property integer $account_id
 * @property string $account_name
 * @property string $exp
 * @property string $recoverexp
 * @property double $x
 * @property double $y
 * @property double $z
 * @property integer $heading
 * @property integer $world_id
 * @property string $gender
 * @property string $race
 * @property string $player_class
 * @property string $creation_date
 * @property string $deletion_date
 * @property string $last_online
 * @property integer $cube_size
 * @property integer $advanced_stigma_slot_size
 * @property integer $warehouse_size
 * @property integer $mailboxLetters
 * @property integer $mailboxUnReadLetters
 * @property string $brokerKinah
 * @property integer $bind_point
 * @property integer $title_id
 * @property integer $online
 * @property string $note
 * @property string $repletionstate
 * @property integer $rebirth_id
 * @property integer $memberpoints
 * @property integer $marry_player_id
 * @property string $marrytitle
 * @property integer $bg_points
 * @property integer $personal_rating
 * @property integer $arena_points
 * @property integer $partner_id
 *
 * The followings are the available model relations:
 * @property Players $partner
 * @property Players[] $players
 */
class Players extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Players the static model class
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
		return 'players';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, name, account_id, account_name, x, y, z, heading, world_id, gender, race, player_class', 'required'),
			array('id, account_id, heading, world_id, cube_size, advanced_stigma_slot_size, warehouse_size, mailboxLetters, mailboxUnReadLetters, bind_point, title_id, online, rebirth_id, memberpoints, marry_player_id, bg_points, personal_rating, arena_points, partner_id', 'numerical', 'integerOnly'=>true),
			array('x, y, z', 'numerical'),
			array('name, account_name', 'length', 'max'=>50),
			array('exp, recoverexp, brokerKinah, repletionstate', 'length', 'max'=>20),
			array('gender', 'length', 'max'=>6),
			array('race', 'length', 'max'=>9),
			array('player_class', 'length', 'max'=>13),
			array('marrytitle', 'length', 'max'=>60),
			array('creation_date, deletion_date, last_online, note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, account_id, account_name, exp, recoverexp, x, y, z, heading, world_id, gender, race, player_class, creation_date, deletion_date, last_online, cube_size, advanced_stigma_slot_size, warehouse_size, mailboxLetters, mailboxUnReadLetters, brokerKinah, bind_point, title_id, online, note, repletionstate, rebirth_id, memberpoints, marry_player_id, marrytitle, bg_points, personal_rating, arena_points, partner_id', 'safe', 'on'=>'search'),
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
			'partner' => array(self::BELONGS_TO, 'Players', 'partner_id'),
			'players' => array(self::HAS_MANY, 'Players', 'partner_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'account_id' => 'Account',
			'account_name' => 'Account Name',
			'exp' => 'Exp',
			'recoverexp' => 'Recoverexp',
			'x' => 'X',
			'y' => 'Y',
			'z' => 'Z',
			'heading' => 'Heading',
			'world_id' => 'World',
			'gender' => 'Gender',
			'race' => 'Race',
			'player_class' => 'Player Class',
			'creation_date' => 'Creation Date',
			'deletion_date' => 'Deletion Date',
			'last_online' => 'Last Online',
			'cube_size' => 'Cube Size',
			'advanced_stigma_slot_size' => 'Advanced Stigma Slot Size',
			'warehouse_size' => 'Warehouse Size',
			'mailboxLetters' => 'Mailbox Letters',
			'mailboxUnReadLetters' => 'Mailbox Un Read Letters',
			'brokerKinah' => 'Broker Kinah',
			'bind_point' => 'Bind Point',
			'title_id' => 'Title',
			'online' => 'Online',
			'note' => 'Note',
			'repletionstate' => 'Repletionstate',
			'rebirth_id' => 'Rebirth',
			'memberpoints' => 'Memberpoints',
			'marry_player_id' => 'Marry Player',
			'marrytitle' => 'Marrytitle',
			'bg_points' => 'Bg Points',
			'personal_rating' => 'Personal Rating',
			'arena_points' => 'Arena Points',
			'partner_id' => 'Partner',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('exp',$this->exp,true);
		$criteria->compare('recoverexp',$this->recoverexp,true);
		$criteria->compare('x',$this->x);
		$criteria->compare('y',$this->y);
		$criteria->compare('z',$this->z);
		$criteria->compare('heading',$this->heading);
		$criteria->compare('world_id',$this->world_id);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('race',$this->race,true);
		$criteria->compare('player_class',$this->player_class,true);
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('deletion_date',$this->deletion_date,true);
		$criteria->compare('last_online',$this->last_online,true);
		$criteria->compare('cube_size',$this->cube_size);
		$criteria->compare('advanced_stigma_slot_size',$this->advanced_stigma_slot_size);
		$criteria->compare('warehouse_size',$this->warehouse_size);
		$criteria->compare('mailboxLetters',$this->mailboxLetters);
		$criteria->compare('mailboxUnReadLetters',$this->mailboxUnReadLetters);
		$criteria->compare('brokerKinah',$this->brokerKinah,true);
		$criteria->compare('bind_point',$this->bind_point);
		$criteria->compare('title_id',$this->title_id);
		$criteria->compare('online',$this->online);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('repletionstate',$this->repletionstate,true);
		$criteria->compare('rebirth_id',$this->rebirth_id);
		$criteria->compare('memberpoints',$this->memberpoints);
		$criteria->compare('marry_player_id',$this->marry_player_id);
		$criteria->compare('marrytitle',$this->marrytitle,true);
		$criteria->compare('bg_points',$this->bg_points);
		$criteria->compare('personal_rating',$this->personal_rating);
		$criteria->compare('arena_points',$this->arena_points);
		$criteria->compare('partner_id',$this->partner_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getAccount($char_id)
        {
            $model=  self::model()->findByPk($char_id);
            return $model->account_name;
        }
}