<?php

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Lineage II',
        'theme'=>'bootstrap',
        'language'=>'ru',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
	),

	'components'=>array(
		'user'=>array(
                        'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
                'authManager' => array(
                    // Будем использовать свой менеджер авторизации
                    'class' => 'PhpAuthManager',
                    // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
                    'defaultRoles' => array('guest'),
                ),
                'bootstrap'=>array(
                    'class'=>'bootstrap.components.Bootstrap',
                ),
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
                        //'caseSensitive'=>false,
			'rules'=>array(
                            '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                            '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                            '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
       
                'Smtpmail'=>array(
                    'class'=>'application.extensions.smtpmail.PHPMailer',
                    'Host'=>"smtp.yandex.ru",
                    'Username'=>'gqdev@yandex.ru',
                    'Password'=>'55599111',
                    'Mailer'=>'smtp',
                    'Port'=>465,
                    'SMTPAuth'=>true, 
                    'SMTPSecure' => 'ssl',
                ),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
                                    'class'=>'CFileLogRoute',
                                    'levels'=>'error, warning',
				),

			),
		),
	),

	// using Yii::app()->params['paramName']
	'params'=>array(
                'rate'=>'100',
		'change_account'=>'100',
                'adminEmail'=>'gqdev@yandex.ru',
                'administrator'=>'',
                'moderator'=>'',
                'adminDomen'=>'lineage7.ru',
                'exchangeCredits' => '0.1',
                'l2topID' =>'8967',
                'urlSrv' => 'http://one.lineage7.ru', // без слеша в конце
                'urlSrvName' => 'Lindvior',
                'urlForum' => 'http://forum.lineage7.ru',
                'robokassaLogin' => 'lineage.kristal-lab.ru',
                'robokassaPass' => 'Qwerty111',
                'robokassaPass2' => 'Qwerty222',
                'testRobokassa' => 'true',
                'PasswordHash' => '', // whirlpool или sha1
	),
);