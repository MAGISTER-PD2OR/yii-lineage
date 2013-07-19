<?php

class PayShopController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','add','accepted','fail'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','list','exchange'),
				'users'=>array(Yii::app()->params['adminName']),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PayShop;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PayShop']))
		{
			$model->attributes=$_POST['PayShop'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PayShop']))
		{
			$model->attributes=$_POST['PayShop'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
        
        public function actionAdd($id)
	{
                        $char_id=$_GET['char'];
                        $count=1;
                        if (PayShop::model()->buyItem($id, $char_id, $count)){
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('accepted'));
                        } else
                        {
			if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('fail'));   
                        }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
             if (!empty($_GET['id'])&& !empty($_GET['name'])){
                $char_id=$_GET['id'];
                $char_name=$_GET['name'];
		$dataProvider=new CActiveDataProvider('PayShop');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
                        'char_id'=>$char_id,
                        'char_name'=>$char_name,
		));
             } else {
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');  
             }
	}
        
        public function actionList() {
		$model=new PayShop('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PayShop']))
			$model->attributes=$_GET['PayShop'];

		$this->render('admin',array(
			'model'=>$model,
		));
        }
        
        public function actionAccepted()
        {
            $this->render('accepted');
        }
        
        public function actionFail()
        {
            $this->render('fail');
        }

        /**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PayShop('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PayShop']))
			$model->attributes=$_GET['PayShop'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=PayShop::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pay-shop-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
	public function actionExchange()
	{
//            $model=new AccountData;
//            if(isset($_POST['AccountData'])){
//            $credits = $_POST['AccountData']['count'];
//            $result=AccountData::model()->exchange(Yii::app()->user->name, $credits);
//                if ($result=='OK'){
//                Yii::app()->user->setFlash('success', 'Начислено '.$credits.' кредитов');
//                $this->redirect(array('/site/exchange'));
//                } else {
//                    Yii::app()->user->setFlash('exchange', $result);
//                }
//            }
            //$this->render('exchange', array('model'=>$model));
            $this->render('exchange');
            
	}
        
}
