<?php
$this->breadcrumbs=array(
        'Магазин'=>array('list'),
	'Добавить товар',
);

?>

<h3>Добавить товар</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>