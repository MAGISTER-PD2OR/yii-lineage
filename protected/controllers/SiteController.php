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
				'actions'=>array('index','login','logout','error','contact','captcha', 'bonus'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('history','getbonus','pass','exchange'),
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
             $this->render('index');
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
				$this->redirect(Yii::app()->user->returnUrl);
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
                $model->scenario = 'update';
                $model->unsetAttributes(array('password'));
            if(isset($_POST['Accounts'])){
            $model->attributes=$_POST['Accounts'];
                if($model->save()){
                Yii::app()->user->setFlash('success', 'Пароль изменен');
                $this->redirect(array('/site/pass'));
                } else {
                    Yii::app()->user->setFlash('pass_error', 'Ошибка. Пароль не изменен');
                }
            }
            $this->render('changepassword', array('model'=>$model));
            
	}
        
}