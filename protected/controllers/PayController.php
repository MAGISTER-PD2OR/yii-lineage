<?php

class PayController extends Controller {
    
    public function actionIndex() {
        $this->layout='//layouts/column2';
        $model = new PayForm;
        if (isset($_POST['PayForm'])) {
            $model->attributes = $_POST['PayForm'];
            if ($model->validate()) {
                $invId = Transactions::model()->logTransactions($model->fio, $model->summ);
                $invDesc = "Пополнение баланса";
                $outSum = intval($model->summ) > 1 ? intval($model->summ) : 1; // invoice summ
// build URL
                $waytopayUrl = "https://waytopay.org/merchant/index?MerchantId=" . Yii::app()->params['waytopayLogin'] ."&OutSum=". $outSum . "&InvId=" . $invId . "&InvDesc=" . $invDesc;
                Yii::app()->request->redirect($waytopayUrl); // redirect to the gate
            }
        }
        $this->render('vip', array(
            'model' => $model,
        ));
    }

    public function actionProcess() {
// HTTP parameters:
        $outSum = $_REQUEST["wOutSum"];
        $invId = $_REQUEST["wInvId"];
        $crc = $_REQUEST["wSignature"];
        $crc = strtoupper($crc); // force uppercase
        $waytopayLogin = Yii::app()->params['waytopayLogin'];
        $waytopayPass = Yii::app()->params['waytopayPass'];
// build own CRC
        $my_crc = strtoupper(md5("$waytopayLogin:$outSum:$invId:$waytopayPass"));
        if (strtoupper($my_crc) != strtoupper($crc)) {
            echo "bad sign\n";
        } else {
            Transactions::model()->logTransactionsOk($outSum, $invId);
            echo "OK_$invId";
        }
    }


}