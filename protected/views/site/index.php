<?php
if (Yii::app()->user->isGuest) {
 $this->redirect(array('site/login'));  
}
$this->pageTitle=Yii::app()->name;
?>

<?php if (Yii::app()->user->name==Yii::app()->params['adminName']) : ?>

<?php endif; ?>