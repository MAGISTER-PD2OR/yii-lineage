<?php
$this->breadcrumbs=array(
	'Баланс'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обновить',
);

?>

<h3>Обновить баланс <?php echo $model->login; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>