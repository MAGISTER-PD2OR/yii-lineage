<?php
$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h3>Редактировать историю <?php echo $model->id; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>