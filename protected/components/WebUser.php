<?php

class WebUser extends CWebUser {
 
    private $_model = null;
    
    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = Accounts::model()->findByPk($this->id, 
                    array('select' => 'login'));
        }
        return $this->_model;
    }

    function getRole() {
        if($user = $this->getModel()){
            if($user->login == Yii::app()->params['administrator']) {
                return 'administrator';
            } elseif($user->login == Yii::app()->params['moderator']) {
                return 'moderator';
            } else {
                return 'user';
            }
        }
    }
    
}