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
            'name' => 'Количество',
            'type' => 'raw',
            'value' => '$data->GridViewCount($data->type)',
        ),
        array(
  'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=> '{on}{test}',
            'buttons' => array(
            	'on' => array(
                    'label' => 'Купить',
                    'icon' => 'icon-plus-sign',
                    'url'   => 'Yii::app()->controller->createUrl("add",array("id"=>$data->primaryKey,"char"=>'.$char_id.'))',
                    'click'=>'function(){return confirm("'.Yii::t('lan','Вы уверены, что хотите купить данный итем?').'");}',
                 ),
       'test' => array
        (
            'label'=>'test',
            'icon' => 'icon-plus-sign',
            'click'=>"function(){
                                    $.fn.yiiGridView.update('pay-shop-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data) {
                                              $('#AjFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');
 
                                              $.fn.yiiGridView.update('pay-shop-grid');
                                        }
                                    })
                                    return false;
                              }
                     ",
            'url'=>'Yii::app()->controller->createUrl("add",array("id"=>$data->primaryKey))',
        ),
             ),

        ),
    ),
));
?>
