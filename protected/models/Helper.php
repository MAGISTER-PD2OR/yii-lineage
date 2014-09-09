<?php

class Helper {

    public static function get_status($host, $port, $timeout = 1) {
        $sock = @fsockopen($host, $port, $errno, $errstr, $timeout);
        //$sock = @stream_socket_client($host, $port, $errno, $errstr, $timeout);
        $online = ($sock > 0);
        if ($online)
            @fclose($sock);
        return $online ? 'On' : 'Off';
    }
    
    public static function get_login_status() {
        $status = self::get_status('localhost', '2106');
        return ($status=='On') ? '<span class="text-success">On</span>' : '<span class="text-error">Off</span>';
    }
    
    public static function get_game_status() {
        $status = self::get_status('localhost', '7777');
        return ($status=='On') ? '<span class="text-success">On</span>' : '<span class="text-error">Off</span>';
    }
    
    public static function get_count_online() {
        $online1 = Yii::app()->db->cache(1000)->createCommand("SELECT COUNT(online) FROM characters WHERE online!=0")->queryScalar();
        $online2 = Yii::app()->db->cache(1000)->createCommand("SELECT COUNT(*) FROM character_variables WHERE name='offline'")->queryScalar();
        $online = intval($online1) + intval($online2);
        return $online; 
    }
    
    public static function renderJSON($data) {
        header('Content-type: application/json');
        echo CJSON::encode($data);
        Yii::app()->end();
    }
    
    public static function renderJSONP($data, $callback) {
      header('Content-type: application/json');
      $json = CJSON::encode($data);
      echo $callback . ' (' . $json . ');';
      Yii::app()->end();
    }   


}
