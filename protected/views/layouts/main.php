<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/styles.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/sticky-footer-navbar.css" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/js/html5shiv/html5shiv.min.js"></script>
<script type="text/javascript" src="/js/respond/respond.min.js"></script>
<![endif]-->
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php
Yii::app()->bootstrap->register();
Yii::app()->clientScript->registerMetaTag($this->getMetaDescription(), 'description');
Yii::app()->clientScript->registerMetaTag($this->getMetaKeywords(), 'keywords'); 
?>
</head>
<body>
<div id="wrap">
<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'type'=>'inverse', // null or 'inverse'
    'collapse'=>false, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>Yii::app()->params['urlSrvName'], 'url'=>Yii::app()->params['urlSrv'], 'linkOptions'=>array('rel'=>'nofollow')),
                array('label'=>'Форум', 'url'=>Yii::app()->params['urlForum'], 'linkOptions'=>array('rel'=>'nofollow', 'target'=>'_blank')),
                array('label'=>'ЛК', 'url'=>array('/site/lk'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Напомнить пароль', 'url'=>array('/site/recovery'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Сервисы', 'url'=>'#', 'items'=>array(
                    array('label'=>'Перенос персонажа', 'icon'=>'icon-share-alt', 'url'=>array('/site/ChangeAccount')),
                    array('label'=>'Перевод баланса', 'icon'=>'icon-random', 'url'=>array('/site/BalanceTransfer')),
                    array('label' => 'Обменник', 'icon' => 'icon-repeat', 'url' => array('/payShop/exchange')),
                    ), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Админка', 'url'=>'#', 'items'=>array(
                    array('label'=>'Баланс', 'url'=>array('/payBalance')),
                    array('label'=>'История', 'url'=>array('/transactions')),
                    array('label'=>'Магазин', 'url'=>'#', 'items'=>array(
                        array('label'=>'Добавить', 'url'=>array('/payShop/create')),
                        array('label'=>'Управление', 'url'=>array('/payShop/list')),
                    )),
                ), 'visible'=>Yii::app()->user->name==Yii::app()->params['adminName'])
            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                    array('label'=>'Регистрация', 'url'=>array('/site/signup'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>Yii::app()->user->name, 'url'=>'#', 'items'=>array(
                    array('label'=>'Пароль', 'icon'=>'icon-cog', 'url'=>array('/site/pass')),
                    array('label'=>'Email', 'icon'=>'icon-cog', 'url'=>array('/site/email')),
                    array('label'=>'Выход', 'icon'=>'icon-off', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ), 'visible'=>!Yii::app()->user->isGuest),
                ),
            ),
    ),
)); ?>
    
<div class="margin_tab"></div>

<?php if(Yii::app()->controller->getRoute()=='site/index') : ?>
<!--<div id="main_bg">
</div>-->
<?php endif; ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

</div><!-- page -->

</div>

<div class="margin_tab"></div>
    
<div class="footer">
    <div class="container">
        <p></p>
        <p class="copyright">Copyright &copy; <?php echo date('Y').' '.Yii::app()->name; ?></p>
        <p class="developer"><?php echo CHtml::link('Контакты', array('/site/contact')); ?></p>
        <div class="clearfix"></div>
        <p>
            <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/images/vkontakte.png', "Мы в контакте", array('width'=>'120px')),
                'http://vkontakte.ru/club22694761', array('rel'=>'nofollow', 'target'=>'_blank')); ?>
            <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/images/l2top.gif', "l2top", array()),
                'http://l2top.ru/vote/'.Yii::app()->params['l2topID'].'/', array('rel'=>'nofollow', 'target'=>'_blank')); ?>
        </p>
        <div class="center">
        <?php $this->renderPartial('//layouts/_counters'); ?>
        </div>
    </div>
</div><!-- footer -->

</body>
</html>
