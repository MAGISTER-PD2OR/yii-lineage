<?php

class Helper {

    public static function get_status($host, $port, $timeout = 1) {
        $sock = @fsockopen($host, $port, $errno, $errstr, $timeout);
        //$sock = @stream_socket_client($host, $port, $errno, $errstr, $timeout);
        $online = ($sock > 0);
        if ($online)
            @fclose($sock);
        return $online ? '<font color=#4F7C4F face=Tahoma>On</font>' : '<font color=#9C5454 face=Tahoma>Off</font>';
    }
    
    public static function get_login_status() {
        return self::get_status('localhost', '2106');
    }
    
    public static function get_game_status() {
        return self::get_status('localhost', '7777');
    }
    
    public static function get_count_online() {
        $online1 = Yii::app()->db->cache(1000)->createCommand("SELECT COUNT(online) FROM characters WHERE online!=0")->queryScalar();
        $online2 = Yii::app()->db->cache(1000)->createCommand("SELECT COUNT(*) FROM character_variables WHERE name='offline'")->queryScalar();
        $online = intval($online1) + intval($online2);
        return $online; 
    }

    public static function get_online() {
        $filename = Yii::getPathOfAlias('webroot') . '/'.'online.txt';
        if (file_exists($filename)) {
            if (time() - 300 > filemtime($filename)) {
                $online = self::get_count_online();
                file_put_contents($filename, $online);
            } else {
                $online = file_get_contents($filename);
                return $online;
            }
        }
    }

}
