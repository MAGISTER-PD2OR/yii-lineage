<?php

/**
 * This is the model class for table "account_data".
 *
 * The followings are the available columns in table 'account_data':
 * @property integer $id
 * @property string $time_pool
 * @property string $name
 * @property string $password
 * @property integer $activated
 * @property integer $access_level
 * @property integer $membership
 * @property integer $last_server
 * @property string $last_ip
 * @property string $last_mac
 * @property string $ip_force
 * @property string $expire
 * @property string $credits
 * @property string $email
 * @property string $last_logout
 */
class AccountData extends CActiveRecord
{
    const SCENARIO_UPDATE = 'update';
    public $password_repeat;
    public $count;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AccountData the static model class
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
		return 'account_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, password', 'required'),
			array('activated, access_level, membership, last_server, count', 'numerical', 'integerOnly'=>true),
			array('time_pool', 'length', 'max'=>32),
			array('name', 'length', 'max'=>45),
			array('last_ip, last_mac, ip_force', 'length', 'max'=>20),
			array('credits, last_logout', 'length', 'max'=>21),
			array('email', 'length', 'max'=>60),
			array('expire', 'safe'),
                        // Длина пароля не менее 4 символов
                        array('password', 'length', 'min'=>4, 'max'=>30),
                        // Длина повторного пароля не менее 4 символов
                        array('password_repeat', 'length', 'min'=>4, 'max'=>30),
                        // Пароль должен совпадать с повторным паролем для сценария регистрации
                        array('password', 'compare', 'compareAttribute'=>'password_repeat', 'on'=>self::SCENARIO_UPDATE),
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
			'time_pool' => 'Time Pool',
			'name' => 'Логин',
			'password' => 'Пароль',
			'activated' => 'Activated',
			'access_level' => 'Access Level',
			'membership' => 'Membership',
			'last_server' => 'Last Server',
			'last_ip' => 'Last Ip',
			'last_mac' => 'Last Mac',
			'ip_force' => 'Ip Force',
			'expire' => 'Expire',
			'credits' => 'Credits',
			'email' => 'Email',
			'last_logout' => 'Last Logout',
                        'password_repeat' => 'Ещё раз пароль',
                        'count' => 'Количество получаемых кредитов',
		);
	}

	public function validatePassword($password)
	{
		return base64_encode(pack('H*', sha1(utf8_encode($password))))===$this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
            return base64_encode(pack('H*', sha1(utf8_encode($password))));
	}
        
    protected function beforeSave()
      {
           if(parent::beforeSave())
           {
              $this->password = $this->hashPassword($this->password);
              return true;
           }
          return false;
      }
        
        public function setBonus($login, $price)
        {
            $date_time_array = getdate(time()); 
            $hours = $date_time_array['hours']; 
            $minutes = $date_time_array['minutes']; 
            $seconds = $date_time_array['seconds']; 
            $month = $date_time_array['mon']; 
            $day = $date_time_array['mday']; 
            $year = $date_time_array['year'];
            $nexttime = mktime($hours + 24,$minutes,$seconds,$month,$day,$year); 
            $account = self::model()->find('name=:name', array(':name'=>$login));
            if (time()<$account->time_pool){
                return 'Вы уже получали бонус за последние 24 часа';
            } else {
            $account->time_pool=$nexttime;
            $account->credits=$account->credits+$price;
            if ($account->saveAttributes(array('time_pool','credits')))
            {
                return 'OK';
            }
            }
        }
        
        public function exchange($login, $count)
        { 
            $account = self::model()->find('name=:name', array(':name'=>$login));
            $balance = PayBalance::model()->find('login=:login', array(':login'=>$login));
            $price_one = Yii::app()->params['exchangeCredits'];
            $price = $count*$price_one;
            if($balance->balance<$price){
                return 'Недостаточно средств';
            } else
            {
            $account->credits=$account->credits+$count;
            $balance->balance=$balance->balance-$price;
            
            if ($account->saveAttributes(array('credits')))
            {
                $balance->saveAttributes(array('balance'));
                Transactions::model()->addTransactionExchange($login, $count, $price_one, $price);
                return 'OK';
            }
            }
        }
        
        public function getBonus($login)
        {
           $account = self::model()->find('name=:name', array(':name'=>$login));
           return $account->credits;
        }
        
        public function setTimeBonus()
        {
            $price = Yii::app()->params['credits'];
            $sql="SELECT account_id, accumulated_online FROM account_time";
            $connection=Yii::app()->db;
            $rows = $connection->createCommand($sql)->queryAll();
            foreach ($rows as $row) {
            $account_id = $row['account_id'];
            $time_online = round($row['accumulated_online'] / 3600000, 0); // 1 час
            $time_online_minus = $time_online*3600000;
            $query1 = 'UPDATE account_data SET credits = credits + '.$price * $time_online.' WHERE id = "'.$account_id.'"';
            $query2 = 'UPDATE account_time SET session_duration = NULL, accumulated_online = accumulated_online - '.$time_online_minus.' WHERE account_id = "'.$account_id.'"';
            
            if ($time_online>=1) {
            $transaction=$connection->beginTransaction();
            try {
            $connection->createCommand($query1)->execute();
            $connection->createCommand($query2)->execute();
            $transaction->commit();
                } 
            catch (Exception $e)
                {
                 $transaction->rollback();
                }
            }
            }
            return 'OK';
        }
     
}