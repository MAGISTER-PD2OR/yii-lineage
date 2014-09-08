Yii_lineage
========
Configuration
------------------------------
Yii_lineage\protected\config\main.php

Yii_lineage\protected\config\production.php

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
                'rate'=>'100',
		'change_account'=>'100',
                'adminEmail'=>'mm555-99@mail.ru',
                'adminName'=>'mazdik',
                'adminDomen'=>'lineage7.ru',
                'waytopayLogin' =>'3236',
                'waytopayPass' =>'3424e8-810cd2-ae915f-d1eefe-63c3',
                'exchangeCredits' => '0.1',
	),
      
```
SQL script
------------------------------
Execute SQL script files in Yii_lineage\protected\data


waytopay
------------------------------
Result URL

http://domen.ru/index.php/pay/process

Success URL

http://domen.ru/

Fail URL

http://domen.ru/

Метод отсылки данных по Result URL

POST



Links
------------------------------
Author http://mazdik.ru/
