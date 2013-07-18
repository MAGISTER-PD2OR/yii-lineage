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
                array('label' => 'Обменник', 'icon' => 'icon-repeat', 'url' => array('site/exchange')),
                array('label' => 'Персонажи'),
            );
            $players= Players::model()->findAll('account_id=:account_id', array(':account_id'=>Yii::app()->user->id));
            foreach ($players as $player) {
                if ($player->online>0) {
                $menu[] = array('label' => $player->name.' (Online)', 'icon' => 'icon-edit', 'url' => '');   
                } else {
                $menu[] = array('label' => $player->name, 'icon' => 'icon-shopping-cart', 'url' => array('/payShop?id='.$player->id.'&name='.$player->name));
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