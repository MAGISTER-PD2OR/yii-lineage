<?php

class PayController extends Controller {
    
    private $mrhLogin;
    private $mrhPass1;
    private $mrhPass2;
    
    public function filters()
    {
            return array(
                    'accessControl', // perform access control for CRUD operations
            );
    }

    public function accessRules()
    {
            return array(
                    array('allow',
                            'actions'=>array('result','fail','success'),
                            'users'=>array('*'),
                    ),
                    array('allow',
                            'actions'=>array('index'),
                            'users'=>array('@'),
                    ),
                    array('deny',  // deny all users
                            'users'=>array('*'),
                    ),
            );
    }
    
    public function init() {
        parent::init();
        $this->mrhLogin = Yii::app()->params['robokassaLogin']; // your login here
        $this->mrhPass1 = Yii::app()->params['robokassaPass']; // merchant pass1 here
        $this->mrhPass2 = Yii::app()->params['robokassaPass2']; // merchant pass2 here
    }
    
    public function send($summ, $invId, $invDesc, $email) {
        $outSum = intval($summ) > 1 ? intval($summ) : 1;
        $crc = md5("$this->mrhLogin:$outSum:$invId:$this->mrhPass1");
        if(Yii::app()->params['testRobokassa']) {
            $roboUrl = "http://test.robokassa.ru/Index.aspx?MrchLogin=";
        } else {
            $roboUrl = "https://merchant.roboxchange.com/Index.aspx?MrchLogin=";
        }
        $roboUrl = $roboUrl . $this->mrhLogin . "&OutSum=" . $outSum . "&InvId=" . $invId . "&Desc=" . $invDesc . "&SignatureValue=" . $crc ."&Email=".$email;
        Yii::app()->request->redirect($roboUrl);
    }
    
    public function actionIndex() {
        $this->layout='//layouts/column2';
        $model = new PayForm;
        if (isset($_POST['PayForm'])) {
            $model->attributes = $_POST['PayForm'];
            if ($model->validate()) {
                $invId = Transactions::model()->logTransactions($model->fio, $model->summ);
                $this->send($model->summ, $invId, "Пополнение баланса", $model->fio);
            }
        }
        $this->render('vip', array(
            'model' => $model,
        ));
    }


    public function actionResult() {
        // HTTP parameters:
        $outSum = $_REQUEST["OutSum"];
        $invId = $_REQUEST["InvId"];
        $crc = $_REQUEST["SignatureValue"];
        $crc = strtoupper($crc); // force uppercase
        // build own CRC
        $my_crc = strtoupper(md5("$outSum:$invId:$this->mrhPass2"));
        if (strtoupper($my_crc) != strtoupper($crc)) {
            echo "bad sign\n";
        } else {
            $this->applyResults($invId, $outSum);
        }
    }

    public function actionFail() {
        $this->layout='//layouts/column2';
        $this->render('canceled');
    }
    
    public function actionSuccess() {
        $this->layout='//layouts/column2';
        $this->render('accepted');
    }
    
    private function applyResults($invId, $outSum) {
        Transactions::model()->logTransactionsOk($outSum, $invId);
        echo "OK$invId\n";
    }


}