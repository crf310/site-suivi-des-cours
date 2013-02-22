Outil de gestion de cours
=========================
Installation
------------
``` shell
 git clone https://github.com/glucazeau/Virgule.git
 Créer parameters.ini dans Virgule/app/config
 cd Virgule
  php composer.phar self-update
 php composer.phar update
  php composer.phar update --dev
 php ./vendor/bin/phing
 php ./vendor/bin/phing data:load # Type "Y"
 http://localhost/Virgule/web/app_dev.php/login
```
parameters.ini
------------
```
[parameters]
    database_driver="pdo_mysql"
    database_host="localhost"
    database_port=""
    database_name=""
    database_user=""
    database_password=""
    mailer_transport="smtp"
    mailer_host="localhost"
    mailer_user=""
    mailer_password=""
    locale="fr"
    secret=""
```
