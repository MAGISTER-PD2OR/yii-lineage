Yii_lineage
========
Configuration
------------------------------
Yii_lineage\protected\config\

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
                'Port'=>465,
                'SMTPAuth'=>true, 
                'SMTPSecure' => 'ssl',
        ),
      
	'params'=>array(
                'rate'=>'100',
		'change_account'=>'100',
                'adminEmail'=>'admin@mail.ru',
                'adminName'=>'player',
                'adminDomen'=>'site.ru',
                'exchangeCredits' => '0.1',
                'l2topID' =>'8967',
                'robokassaLogin' => '',
                'robokassaPass' => '',
                'robokassaPass2' => '',
                'testRobokassa' => 'true',
	),
      
```
SQL script
------------------------------
Execute SQL script files in Yii_lineage\protected\data


robokassa
------------------------------
Result URL
http://domen.ru/index.php/pay/result

Success URL
http://domen.ru/index.php/pay/success

Fail URL
http://domen.ru/index.php/pay/fail

Метод отсылки данных по Result URL
POST


Links
------------------------------
Author http://mazdik.ru/
