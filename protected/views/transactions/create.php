<?php
$this->breadcrumbs=array(
	'История'=>array('index'),
	'Добавить',
);
?>

<h3>Добавить запись</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>