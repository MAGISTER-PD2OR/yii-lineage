<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
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
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                         'generatorPaths'=>array(
                        'bootstrap.gii',
                        ),
		),
		/**/
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
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=la2',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'vertrigo',
			'charset' => 'utf8',
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
		'credits'=>'100',
                'adminEmail'=>'mm555-99@mail.ru',
                'adminName'=>'mazdik',
                'adminDomen'=>'lineage7.ru',
                'waytopayLogin' =>'3236',
                'waytopayPass' =>'3424e8-810cd2-ae915f-d1eefe-63c3',
                'exchangeCredits' => '0.1',
	),
);