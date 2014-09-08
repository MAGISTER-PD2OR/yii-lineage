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

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
                'bootstrap'=>array(
                    'class'=>'bootstrap.components.Bootstrap',
                ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        //'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
       
                'Smtpmail'=>array(
                    'class'=>'application.extensions.smtpmail.PHPMailer',
                    'Host'=>"smtp.mail.ru",
                    'Username'=>'admin@mail.ru',
                    'Password'=>'password',
                    'Mailer'=>'smtp',
                    'Port'=>25,
                    'SMTPAuth'=>true, 
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
                'adminEmail'=>'mm555-99@mail.ru',
                'adminName'=>'mazdik',
                'adminDomen'=>'lineage7.ru',
                'waytopayLogin' =>'3236',
                'waytopayPass' =>'3424e8-810cd2-ae915f-d1eefe-63c3',
                'exchangeCredits' => '0.1',
	),
);