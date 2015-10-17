<?php
return CMap::mergeArray(
        require (dirname(__FILE__).'/main.php'),
        array(
        'components'=>array(
                'session'=>array(
                        'class'=>'CHttpSession',
                        'useTransparentSessionID' =>($_POST['PHPSESSID']) ? true : false,
                 ),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=la2',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'vertrigo',
			'charset' => 'utf8',
			'schemaCachingDuration'=>180,
		),
            ),
        )
        );