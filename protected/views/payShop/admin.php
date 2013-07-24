<?php
$this->breadcrumbs=array(
	'Магазин'
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pay-shop-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Управление магазином</h3>

<p>
Можно ввести оператор сравнения (<, <=,>,> =, <> или =) в начале каждого из ваших значений поиска.
</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pay-shop-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'type',
		'pic',
		'item_name',
		'description',
		'price',
		'status',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
