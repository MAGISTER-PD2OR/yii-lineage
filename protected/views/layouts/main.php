<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'type'=>'inverse', // null or 'inverse'
    'collapse'=>false, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Главная', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Контакты', 'url'=>array('/site/contact'), 'visible'=>!Yii::app()->user->isGuest),
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
                    array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Регистрация', 'url'=>array('/site/signup'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>Yii::app()->user->name, 'url'=>'#', 'items'=>array(
                    array('label'=>'Пароль', 'icon'=>'icon-cog', 'url'=>array('/site/pass')),
                    array('label'=>'Выход', 'icon'=>'icon-off', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ), 'visible'=>!Yii::app()->user->isGuest),
                ),
            ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
