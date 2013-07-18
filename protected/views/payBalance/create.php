<?php
$this->breadcrumbs=array(
	'Баланс'=>array('index'),
	'Добавить',
);

?>

<h3>Пополнить баланс</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>