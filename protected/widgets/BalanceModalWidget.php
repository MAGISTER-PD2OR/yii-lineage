<?php

    class BalanceModalWidget extends CWidget {
        
        public function init()
	{
	}
        
        public function run(){
            
            $model = new PayBalance;
            
            $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'balanceModal'));
     
            echo '<div class="modal-header">';
            echo '<a class="close" data-dismiss="modal">×</a>';
            echo '<h4>Пополнение балансов игроков</h4>';
            echo '</div>';

            echo '<div class="modal-body">';
            $this->render('application.views.payBalance._add', array('model' => $model)); 
            echo '</div>';

            echo '<div class="modal-footer">';
            $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Закрыть',
            'url'=>'#',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
            ));
            
            echo '</div>';
            $this->endWidget();
            
            $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Пополнить баланс новому аккаунту',
            'htmlOptions'=>array(
            'data-toggle'=>'modal',
            'data-target'=>'#balanceModal',
            ),
            ));
            
        }

    }
