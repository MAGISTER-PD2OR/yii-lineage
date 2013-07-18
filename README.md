Yii_lineage
========
Configuration
------------------------------
Yii_lineage\protected\config\main.php
```php

	'db'=>array(
		'connectionString' => 'mysql:host=localhost;dbname=lineage_db',
		'emulatePrepare' => true,
		'username' => 'root',
		'password' => 'passowrd',
		'charset' => 'utf8',
		),
    
	'Smtpmail'=>array(
	      'class'=>'application.extensions.smtpmail.PHPMailer',
	      'Host'=>"smtp.mail.ru",
	      'Username'=>'admin@mail',
	      'Password'=>'password',
	      'Mailer'=>'smtp',
	      'Port'=>25,
	      'SMTPAuth'=>true, 
    ),
      
	'params'=>array(
		'credits'=>'100',
		'adminEmail'=>'admin@mail',
		'adminName'=>'admin',
		'adminDomen'=>'aion7.ru',
		'waytopayLogin' =>'7777',
		'waytopayPass' =>'3424e8-810cd2-ae915f-d1eefe-63c3',
        'exchangeCredits' => '0.1',
	),
      
```
SQL script
------------------------------
Execute SQL script files in Yii_lineage\protected\data


### Links

Author http://mazdik.ru/
