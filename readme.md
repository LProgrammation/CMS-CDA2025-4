# Contributeur du projet CMS :

Les personnes ayant contribué au développement du projet CMS sont les suivantes :  
– Lenny Moinardeau (Maquettage BDD, correctif de bug et merge de l'ensemble du site, gestion des connexion et inscription (user), gestion admin (user))  
– Baptiste Freminet (Marquettage BDD, gestion des pages, gestion des logs)  
– Maureen Denolf (Maquettage BDD, Gestion des sites, Gestion de la page d'accueil)  
– Louis Potdevin (MVC, Sécurité/Gestion des accès, Gestion des modules en lien avec l'utilisation du mvc, migrations, correctif de bug et merge de l'ensemble du site)  

# Structure MVC :

L'ensemble de la structure MVC a été produite et pensée par Louis Potdevin dans son ensemble, incluant un ensemble de  
modules et de systèmes de routage qui ont été ou seront retravaillés dans le cadre du projet dit "CMS".  
Le fonctionnement est le suivant :  
– Les controller font appel aux view ainsi qu'aux models permettant de traiter les données récupérées via les méthodes  
des différents models dont les données seront exploitées par les différentes parties view.  
– La connexion à la base de données est initialisée dès le début du chargement du site afin d'y avoir accès durant toute  
la navigation.  
– Le routeur gère les redirections en fonction des routes définies via la méthode routeMap() de la classe router.  
Différents modules sont disponibles dans le but de faciliter le développement et de créer du code réutilisable,  
notamment pour le routeur, la gestion d'accès admin/user et la génération aléatoire d'identifiants via la méthode UUID  
Version 4.

# Instruction d'initialisation du project :
## ATTENTION : Il est important de modifier les informations de connexion à la base de données dans le fichier .ENV ainsi que dans les scripts d'interaction avec la base de données.

- composer

Afin d'avoir accès au fichier d'environnement qui est obligatoire pour l'accès aux bases de données ou API, il est
important d'exécuter la commande suivante :
composer install
Ce qui aura pour effet de récupérer les composants obligatoires pour le bon fonctionnement du code, notamment pour le
chargement du fichier d'environnement avec phpdotenv de vlucas et d'autres composants qui pourraient être également
nécessaires (voir le fichier composer.json).

# Les scripts :

Il existe un scipt afin de crée manuellement un utilisateur, ainsi qu'un script pour gérer les migrations l'utilisation
de ses deux scripts peut être éxécuter depuis la racine du projet avec les commandes suivante :

- php ./ressources/accountCreation.php --firstname_user=firstname --name_user=lastname --email_user=example@gmail.com
  --password_user=azerty --role_user=admin ou user
- php ./resssources/scriptMigration --mode=next (next est remplaçable par prev/migrate/reset/locallist/history)