<?php
Yii::import('zii.widgets.CPortlet');

class UserMenu extends CPortlet {

    public function init() {
        parent::init();
    }
    
    protected function renderContent() {
        if (!Yii::app()->user->isGuest) {
        $menu = array(
            array('label' => Yii::app()->user->name),
            array('label' => 'Баланс: ' . Transactions::model()->getBalanse(Yii::app()->user->name), 'url' => ''),
            array('label' => 'Пополнить баланс ', 'icon' => 'icon-plus-sign', 'url' => array('/pay/index')),
            array('label' => 'История', 'icon' => 'icon-list', 'url' => array('/site/history')),
            array('label' => 'Персонажи'),
        );
        $players= Characters::model()->findAll('account_name=:account_name', array(':account_name'=>Yii::app()->user->name));
        foreach ($players as $player) {
            if ($player->online>0) {
            $menu[] = array('label' => $player->char_name.' (Online)', 'icon' => 'icon-edit', 'url' => '');   
            } else {
            $menu[] = array('label' => $player->char_name, 'icon' => 'icon-shopping-cart', 'url' => array('/payShop?id='.$player->obj_Id.'&name='.$player->char_name));
                } 
            }
        $this->widget('bootstrap.widgets.TbMenu', array(
            'items' => $menu,
            'type' => 'list', // '', 'tabs', 'pills' (or 'list')
            'stacked' => false, // whether this is a stacked menu
        ));
        }
    }
    
}
