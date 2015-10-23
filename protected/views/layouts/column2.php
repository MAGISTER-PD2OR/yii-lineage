<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span3">
        <div id="sidebar">
<?php 
if ($this->route == 'site/index' ||
        $this->route == 'site/contact' ||
        $this->route == 'site/recovery' ||
        $this->route == 'site/login' ||
        $this->route == 'site/signup') {

    if ($this->beginCache('sidebar', array('duration' => 120))) {
?>
        <ul class="bs-docs-sidenav">
            <li class="mynav-header">Статистика <?php echo Yii::app()->name; ?></li>
            <li>Онлайн: <span class="text-success"><?php echo Helper::get_count_online(); ?></span></li>
            <li>Login: <?php echo Helper::get_login_status(); ?></li>
            <li>Game: <?php echo Helper::get_game_status(); ?></li>
            <li>Рейты: x<?php echo Yii::app()->params['rate']; ?></li>
            <li>Аккаунтов: <?php echo Helper::get_count_accounts(); ?></li>
            <li>Персонажей: <?php echo Helper::get_count_characters(); ?></li>
        </ul>
        <?php 
        if(!empty(Yii::app()->params['urlSrv'])) {
            $json_url = Yii::app()->params['urlSrv'].'/index.php/site/getdata?callback=df';
            $json = @file_get_contents($json_url);
            if ($json === false) {
                $data['login_status']='<span class="text-error">Off</span>';
                $data['game_status']='<span class="text-error">Off</span>'; 
            } else {
            $data = Helper::jsonp_decode($json, TRUE);
            }
        ?>  
        <ul class="bs-docs-sidenav">
            <li class="mynav-header">Статистика <?php echo (!empty($data['name'])) ? $data['name'] : ''; ?></li>
            <li>Онлайн: <span class="text-success"><?php echo (!empty($data['online'])) ? $data['online'] : ''; ?></span></li>
            <li>Login: <?php echo (!empty($data['login_status'])) ? $data['login_status'] : ''; ?></li>
            <li>Game: <?php echo (!empty($data['game_status'])) ? $data['game_status'] : ''; ?></li>
            <li>Рейты: <?php echo (!empty($data['rate'])) ? 'x'.$data['rate'] : ''; ?></li>
            <li>Аккаунтов: <?php echo (!empty($data['accounts'])) ? $data['accounts'] : ''; ?></li>
            <li>Персонажей: <?php echo (!empty($data['characters'])) ? $data['characters'] : ''; ?></li>
        </ul>
 <?php 
        }
        $this->endCache();
    }
} else {
    $this->widget('UserMenu');
}
?> 

        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>