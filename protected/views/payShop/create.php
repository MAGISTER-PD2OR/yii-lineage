<?php
$this->breadcrumbs=array(
	'Магазин'=>array('index'),
	'Добавить',
);

?>

<h3>Добавить товар</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>