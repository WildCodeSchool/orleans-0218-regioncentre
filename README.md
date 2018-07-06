E-Maintenance [ENGLISH INSTRUCTIONS]
====================================

Howdy, this is the manual for install and manage E-Maintenance, the management system of working sheet of the Centre-Val de Loire county.

E-Maintenance is hosted on the Github platform at the adress :
https://github.com/WildCodeSchool/orleans-0218-regioncentre



1) Clone E-Maintenance on your server :

	```
	git clone https://github.com/WildCodeSchool/orleans-0218-regioncentre.git
   ```


2) Install Composer softwar :
	```
	composer install
    ```

3) Install npm softwar :
	```
	npm install
	```

4) Create a database :
	```
	php bin/console doctrine:database:create
	```

5) Update database :
	```
	php bin/console doctrine schema:update --force
	```

6) Run Webpack :
	```
	./node_modules/.bin/encore production
	```


E-Maintenance [Instructions en Français]
========================================

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
	php bin/console doctrine schema:update --force
	```

6) Exécuter Webpack, éxécuter la commande :
	```
	./node_modules/.bin/encore production
	```


A propos / About
================
**E-Maintenance...**
>...et un projet Symfony créé le 16 mai 2018.

>...is a Symfony project created on May 16, 2018.