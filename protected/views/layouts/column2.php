<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span3">
        <div id="sidebar">
            <?php
            if (!Yii::app()->user->isGuest) {
            $menu = array(
                array('label' => Yii::app()->user->name),
                array('label' => 'Баланс: ' . Transactions::model()->getBalanse(Yii::app()->user->name), 'url' => ''),
                array('label' => 'Пополнить баланс ', 'icon' => 'icon-plus-sign', 'url' => array('/pay')),
                array('label' => 'История', 'icon' => 'icon-list', 'url' => array('site/history')),
                array('label' => 'Обменник', 'icon' => 'icon-repeat', 'url' => array('/payShop/exchange')),
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
            ?>
        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>