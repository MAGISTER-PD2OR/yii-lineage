<?php
$this->breadcrumbs = array(
    $char_name,
);
?>

<h3>Персонаж: <?php echo $char_name; ?></h3>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'pay-shop-grid',
    'dataProvider' => $dataProvider,
    'type' => 'striped bordered',
    'columns' => array(
    array(
      'name'=>'pic',
      'type'=>'image',
      'value'=>'$data->pic',
    ),
        'id',
        'type',
        'item_name',
        'description',
        'price',
        array(
            'type'=>'raw',
            'value'=>'$data->getLink($data, '.$char_id.')',
        ),
//        array(
//  'class'=>'bootstrap.widgets.TbButtonColumn',
//            'template'=> '{on}',
//            'buttons' => array(
//            	'on' => array(
//                    'label' => 'Купить',
//                    'icon' => 'icon-plus-sign',
//                    'url'   => 'Yii::app()->controller->createUrl("add",array("id"=>$data->primaryKey,"char"=>'.$char_id.'))',
//                    'click'=>'function(){return confirm("'.Yii::t('lan','Вы уверены, что хотите купить данный итем?').'");}',
//                 ),
//
//             ),
//
//        ),
    ),
));
?>
