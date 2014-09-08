<?php

class SiteController extends Controller
{
    public $attempts = 2;
    public $counter;
    public $layout='//layouts/column2';
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
    public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index','login','logout','error','contact','captcha','signup','recovery','getdata'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('history','pass','email','changeaccount','balancetransfer','lk'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        
        private function captchaRequired()
        {
        return Yii::app()->session->itemAt('captchaRequired') >= $this->attempts;
        }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            $this->layout=null;
            $this->render('index');
	}
        
	public function actionLk()
	{
            $this->render('lk');
	}

	public function actionHistory()
	{
                $model=new Transactions('search');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Transactions']))
			$model->attributes=$_GET['Transactions'];

		$this->render('history',array(
			'model'=>$model
		));
	}
        
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
		if($model->validate())
		{
                    $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
		    $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                    $body = $model->body.'<br>Email отправителя: '.$model->email;
                                
                    $mail=Yii::app()->Smtpmail;
                    $mail->CharSet = 'UTF-8';
                    $mail->SetFrom(Yii::app()->params['adminEmail'], Yii::app()->params['adminDomen']);
                    $mail->Subject = $subject;
                    $mail->MsgHTML($body);
                    $mail->AddAddress(Yii::app()->params['adminEmail'], "");
                    if(!$mail->Send()) {
                     Yii::app()->user->setFlash('contact', 'Mailer Error: '.$mail->ErrorInfo);
                     $this->refresh();
                    }else {
                     Yii::app()->user->setFlash('contact','Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.');
                     $this->refresh();
                    }                  
		}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
                $this->layout='//layouts/column1';
		$model = $this->captchaRequired()? new LoginForm('captchaRequired') : new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array('/site/lk'));
                        else
                          {
                            $this->counter = Yii::app()->session->itemAt('captchaRequired') + 1;
                            Yii::app()->session->add('captchaRequired',$this->counter);
                          }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionPass()
	{
            $model = Accounts::model()->find('login=:login', array(':login'=>Yii::app()->user->name));
                if (!isset($model))
                    throw new CHttpException(404);
                $model->scenario = Accounts::SCENARIO_UPDATE;
                $model->unsetAttributes(array('password'));
            if(isset($_POST['Accounts'])){
            $model->attributes=$_POST['Accounts'];
                if($model->save(false)){
                Yii::app()->user->setFlash('success', 'Пароль изменен');
                $this->redirect(array('/site/pass'));
                } else {
                    Yii::app()->user->setFlash('pass_error', 'Ошибка. Пароль не изменен');
                }
            }
            $this->render('changepassword', array('model'=>$model));
            
	}
        
          public function actionSignup() 
          { 
              $model=new Accounts(Accounts::SCENARIO_SIGNUP);

              if(isset($_POST['Accounts'])) 
              { 
                  $model->attributes=$_POST['Accounts']; 
                  if($model->save()) {
                      $body = 'Здравствуйте, '.$model->login.'\n Поздравляем - Вы успешно зарегистрированы на сайте '.Yii::app()->params['adminDomen'];
                      $result = $this->sendEmail($model->email, 'Регистрация', $body);
                      if ($result===true) {
                          $result_email =  'На ваш email <b>'.$model->email.'</b> отправлено письмо';
                      } else {
                          $result_email = 'Ошибка отправки email: '.$result;
                      }
                      Yii::app()->user->setFlash('success', 'Аккаунт <b>'.$model->login.'</b> создан. '.$result_email);
                      $this->redirect(array('signup')); 
                  }
              } 

              $this->render('signup',array( 
                  'model'=>$model, 
              )); 
          }
          
          public function actionRecovery()
          {
              $form = new RecoveryForm;
                if(isset($_POST['RecoveryForm'])) {
                $form->attributes=$_POST['RecoveryForm'];
                if($form->validate()) {
                        $model = Accounts::model()->find('login=:login and email=:email', array(':login'=>$form->login, ':email'=>$form->email));
                if (!isset($model)) {
                    Yii::app()->user->setFlash('pass_error', 'Пользователя с таким логином и е-mail адресом не обнаружено');
                } else {
                  $new_password = substr(md5(date('YmdHis')), 2, 6);
                  $model->password=$new_password;
                  if($model->save(false)) {
                      $body = 'Здравствуйте, '.$model->login.'\n Мы сгененриоровали для Вас пароль, теперь Вы сможете войти в игру, используя его. После входа желательно его сменить.\n Пароль: '.$new_password;
                      $result = $this->sendEmail($model->email, 'Восстановление пароля', $body);
                      if ($result===true) {
                          $result_email =  'На ваш email <b>'.$model->email.'</b> отправлено письмо';
                      } else {
                          $result_email = 'Ошибка отправки email: '.$result;
                      }
                      Yii::app()->user->setFlash('success', $result_email);
                      $this->redirect(array('recovery')); 
                        }
                    }
                  }
                }
              $this->render('recovery',array('model'=>$form));
              
          }

          public function sendEmail($email, $subject, $body) {
              
                $subject='=?UTF-8?B?'.base64_encode($subject).'?=';

                $mail=Yii::app()->Smtpmail;
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom(Yii::app()->params['adminEmail'], 'noreply@'.Yii::app()->request->serverName);
                $mail->Subject = $subject;
                $mail->MsgHTML($body);
                $mail->AddAddress($email, "");
                if(!$mail->Send()) {
                    return $mail->ErrorInfo;
                }else {
                    return true;
                } 
              
          }
          
        public function actionEmail()
	{
            $model = Accounts::model()->find('login=:login', array(':login'=>Yii::app()->user->name));
                if (!isset($model))
                    throw new CHttpException(404);
            $model->scenario = Accounts::SCENARIO_SIGNUP;
            if(isset($_POST['Accounts'])){
            $model->attributes=$_POST['Accounts'];
            $attribs = array('email');
                if ($model->validate($attribs)){
                    if( $model->saveAttributes($attribs) ) {
                        Yii::app()->user->setFlash('success', 'Email изменен');
                        $this->redirect(array('/site/email'));
                    }
                } else {
                    Yii::app()->user->setFlash('pass_error', 'Ошибка. Email не изменен');
                }
            }
            $this->render('changemail', array('model'=>$model));
            
	}
        
        public function actionChangeAccount()
        {
          $from_login = Yii::app()->user->name;
          $model = new Characters;

            if(isset($_POST['Characters'])){
                
            $model->attributes=$_POST['Characters'];
            $balance = PayBalance::model()->find('login=:login', array(':login'=>$from_login));
            
            if($balance->balance<Yii::app()->params['change_account']){
                $result='Недостаточно средств';
            } else {
            $result = $model->change_account($model->account_name, $model->char_name, $balance, $from_login);
            }

                Yii::app()->user->setFlash('pass_error', $result);
                $this->redirect(array('/site/ChangeAccount'));
                }
          $this->render('change_account', array('model'=>$model));  
        }
        
        public function actionBalanceTransfer()
        {
                $flash = 'error';
                $from_login = Yii::app()->user->name;
		$model=new PayBalance;

		if(isset($_POST['PayBalance']))
		{
			$model->attributes=$_POST['PayBalance'];
                        $my_balance = PayBalance::model()->find('login=:login', array(':login'=>$from_login));
                        if ($from_login==$model->login) {
                            $result = 'Нельзя переводить средства на свой аккаунт';
                        } else {
                        if($my_balance->balance<$model->balance){
                            $result='Недостаточно средств';
                        } else {
                        $account = Yii::app()->db->createCommand("SELECT 1 FROM accounts where login='$model->login'")->queryScalar();
                        if ($account<>1) {
                            $result= 'Аккаунт не найден';
                        } else {
                            $target_balance = PayBalance::model()->find('login=:login', array(':login'=>$model->login));
                              if (!isset($target_balance)) {
                                  $target_new_balance = new PayBalance;
                                  $target_new_balance->login=$model->login;
                                  $result = $this->balanceTransfer($my_balance, $target_new_balance, $model, $from_login);
                                  if (substr($result, 0, 5)!=='Error')
                                  $flash = 'success';
                              } else {
                                  $result = $this->balanceTransfer($my_balance, $target_balance, $model, $from_login);
                                  if (substr($result, 0, 5)!=='Error')
                                  $flash = 'success';
                              }
                           }
                         }
                        }
                        Yii::app()->user->setFlash($flash, $result);
			$this->redirect(array('/site/BalanceTransfer'));
		}

		$this->render('balancetransfer',array('model'=>$model,));
        }
        
        public function balanceTransfer($my_balance, $target_balance, $model, $from_login)
        {
            $target_balance->balance=$target_balance->balance+$model->balance;
             if ($target_balance->save()) {
                 $my_balance->balance=$my_balance->balance-$model->balance;
                 $my_balance->saveAttributes(array('balance'));
                 Transactions::model()->addTransaction($from_login, '', 4, "Перевод средств на аккаунт $model->login", 1, $model->balance);
                 return "Средства $model->balance переведены на аккаунт $model->login";
             } else {
                 return 'Error. Невозможно перевести средства';
             }
        }
        
    public static function actionGetData() {
        $login_status = Helper::get_status('localhost', '2106');
        $game_status = Helper::get_status('localhost', '7777');
        $online = Helper::get_count_online();
        $data = array('login_status'=>$login_status, 'game_status'=>$game_status, 'online'=>$online);
        Helper::renderJSON($data);
    }

}