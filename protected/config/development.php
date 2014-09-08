<?php
return CMap::mergeArray(
        require (dirname(__FILE__).'/main.php'),
        array(
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths'=>array(
                             'bootstrap.gii',
                ),
            ),

	),
        'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=la2',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'vertrigo',
			'charset' => 'utf8',
		),
            ),
        )
        );