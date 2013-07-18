<?php
$this->breadcrumbs=array(
	'История',
);
?>

<h3>История</h3>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'transactions-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'type' => 'striped bordered',
	'columns'=>array(
		'ip',
		'login',
		'char_name',
		'item_type',
		'item_name',
		'count',
                array('name'=>'price_one', 'footer'=>'<b>Итого:</b>'),
                array(
                    'name'=>'price_final',
                    'class'=>'bootstrap.widgets.TbTotalSumColumn'
                ),
                array(
                'name'=>'trans_date',
                'type'=>'date',
                'value'=>'$data->trans_date',
                ),
		/**/
	),
)); ?>
