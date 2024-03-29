<?php
$this->breadcrumbs=array(
	'История'
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('transactions-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Управление историей</h3>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'transactions-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'ip',
		'login',
		'char_name',
		'item_type',
		'item_name',
		'count',
		'price_one',
		'price_final',
                array(
                'name'=>'trans_date',
                'type'=>'date',
                'value'=>'$data->trans_date',
                ),
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view} {update} {delete}',
                    'buttons'=>array(
                        'update' => array
                        (
                            'visible'=>'Yii::app()->user->checkAccess("administrator")',
                        ),
                        'delete' => array
                        (
                            'visible'=>'Yii::app()->user->checkAccess("administrator")',
                        ),
                    ),
		),
	),
)); ?>
