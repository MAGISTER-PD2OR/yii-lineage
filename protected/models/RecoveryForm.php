<?php

/**
 * UserRecoveryForm class.
 * UserRecoveryForm is the data structure for keeping
 * user recovery form data. It is used by the 'recovery' action of 'UserController'.
 */
class RecoveryForm extends CFormModel {
	public $login, $email;
        public $verifyCode;
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('login, email', 'required'),
                        array('login', 'length','min'=>4, 'max'=>32),
			array('login', 'match', 'pattern' => '/^[A-z][\w]+$/','message' => "Неправильные символы (A-z0-9)."),
			array('email', 'email'),
                        array('email', 'length', 'min'=>6, 'max'=>45),
			//array('login', 'checkexists'),
                        array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'login'=>'Логин',
                        'email'=>'Email',
                        'verifyCode' => 'Код проверки',
		);
	}
	
	public function checkexists($attribute,$params) {
		if(!$this->hasErrors())
		{
                        $account = Accounts::model()->find('login=:login and email=:email', array(':login'=>$this->login, ':email'=>$this->email));
			if($account===null)
			$this->addError("login","Пользователя с таким логином и е-mail адресом не обнаружено");
		}
	}
	
}