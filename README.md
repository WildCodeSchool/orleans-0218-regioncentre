E-Maintenance
=============

Bonjour, voici comment installer et maintenir E-Maintenance, le système de gestion des fiches de travaux de la région *Centre-Val de Loire*.


E-Maintenance est hébergé sur la plateforme Github à l'adresse :
https://github.com/WildCodeSchool/orleans-0218-regioncentre

1) Cloner E-Maintenance sur votre serveur :
	```
	git clone https://github.com/WildCodeSchool/orleans-0218-regioncentre.git

2) Installer Composer, éxécuter la commande :
	```
	composer install
    ```

3) Installer npm, éxécuter la commande :
	```
	npm install
	```

4) Créer une base de données, éxécuter la commande :
	```
	php bin/console doctrine:database:create
	```

5) Mettre à jour la base de données, éxécuter la commande :
	```
	[Optionnel - Pour information]
	php bin/console doctrine schema:update --dump-sql
	```

	```
	php bin/console doctrine schema:update --force
	```

6) Exécuter Webpack, éxécuter la commande :
	```
	./node_modules/.bin/encore production
	```
7) Les paramètres pour la connexion au serveur d'envoi de courriels sont définis dans **parameters.yml**
	```
    ~app/config/parameters.yml
	```

A propos / About
================
**E-Maintenance...**
>...et un projet PHP/Symfony 3.4 créé le 16 mai 2018.

>...is a PHP/Symfony 3.4 project created on May 16, 2018.
