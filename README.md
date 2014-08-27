Outil de gestion de cours
=========================
Installation
------------
1. Créer une base de données
2. Cloner le repository: ```git clone https://github.com/glucazeau/Virgule.git```
3. Renommer  `parameters.ini.dist` en `parameters.ini` dans Virgule/app/config
4. Dans ce fichier, renseigner les paramètres suivant: 
    - database_port
    - database_name
    - database_user
    - database_password
    - secret (n'importe quelle valeur)
4. Se rendre dans le répertoire "Virgule"
5. Télécharger les dépendances via Composer ```php composer.phar self-update``` puis ```php composer.phar update```
6. Créer les tables : ```php ./vendor/bin/phing```
7. Charger les données (le script ne vous le demandera pas mais il faut taper "Y" puis Entrée pour confirmer): ```php ./vendor/bin/phing data:load```
8. Accéder au site à cette adresse: http://localhost/Virgule/web/app_dev.php/login


Développement
-------------
Ce repository est configuré pour utiliser git-flow, les push requests se font sur develop ou une branche feature.

Voir :
* http://nvie.com/posts/a-successful-git-branching-model/
* http://danielkummer.github.io/git-flow-cheatsheet/
