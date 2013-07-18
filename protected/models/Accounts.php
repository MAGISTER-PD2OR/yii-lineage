<?php

/**
 * This is the model class for table "accounts".
 *
 * The followings are the available columns in table 'accounts':
 * @property string $login
 * @property string $password
 * @property integer $last_access
 * @property integer $access_level
 * @property string $last_ip
 * @property integer $last_server
 * @property integer $bonus
 * @property integer $bonus_expire
 * @property integer $ban_expire
 * @property string $allow_ip
 * @property string $allow_hwid
 * @property integer $points
 * @property string $email
 * @property string $email_activ_code
 * @property string $email_activated
 * @property string $ident_code
 * @property string $ban_time_ipsys
 */
class Accounts extends CActiveRecord
{
    const SCENARIO_UPDATE = 'update';
    public $password_repeat;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Accounts the static model class
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
		return 'accounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password', 'required'),
			array('last_access, access_level, last_server, bonus, bonus_expire, ban_expire, points', 'numerical', 'integerOnly'=>true),
			array('login', 'length', 'max'=>32),
			array('allow_ip, allow_hwid', 'length', 'max'=>255),
			array('last_ip', 'length', 'max'=>15),
			array('email, email_activ_code, email_activated, ident_code, ban_time_ipsys', 'length', 'max'=>45),
                        // Длина пароля не менее 4 символов
                        array('password', 'length', 'min'=>4, 'max'=>30),
                        // Длина повторного пароля не менее 4 символов
                        array('password_repeat', 'length', 'min'=>4, 'max'=>30),
                        // Пароль должен совпадать с повторным паролем для сценария регистрации
                        array('password', 'compare', 'compareAttribute'=>'password_repeat', 'on'=>self::SCENARIO_UPDATE),
			array('login, password, last_access, access_level, last_ip, last_server, bonus, bonus_expire, ban_expire, allow_ip, allow_hwid, points, email, email_activ_code, email_activated, ident_code, ban_time_ipsys', 'safe', 'on'=>'search'),
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
			'login' => 'Login',
			'password' => 'Password',
			'last_access' => 'Last Access',
			'access_level' => 'Access Level',
			'last_ip' => 'Last Ip',
			'last_server' => 'Last Server',
			'bonus' => 'Bonus',
			'bonus_expire' => 'Bonus Expire',
			'ban_expire' => 'Ban Expire',
			'allow_ip' => 'Allow Ip',
			'allow_hwid' => 'Allow Hwid',
			'points' => 'Points',
			'email' => 'Email',
			'email_activ_code' => 'Email Activ Code',
			'email_activated' => 'Email Activated',
			'ident_code' => 'Ident Code',
			'ban_time_ipsys' => 'Ban Time Ipsys',
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

		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('last_access',$this->last_access);
		$criteria->compare('access_level',$this->access_level);
		$criteria->compare('last_ip',$this->last_ip,true);
		$criteria->compare('last_server',$this->last_server);
		$criteria->compare('bonus',$this->bonus);
		$criteria->compare('bonus_expire',$this->bonus_expire);
		$criteria->compare('ban_expire',$this->ban_expire);
		$criteria->compare('allow_ip',$this->allow_ip,true);
		$criteria->compare('allow_hwid',$this->allow_hwid,true);
		$criteria->compare('points',$this->points);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('email_activ_code',$this->email_activ_code,true);
		$criteria->compare('email_activated',$this->email_activated,true);
		$criteria->compare('ident_code',$this->ident_code,true);
		$criteria->compare('ban_time_ipsys',$this->ban_time_ipsys,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
}