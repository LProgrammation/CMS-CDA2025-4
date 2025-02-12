# Contributeur du projet CMS : 
Les personnes ayant contribué au développement du projet CMS sont les suivantes :
– Lenny Moinardeau (Maquettage BDD)
– Baptiste Freminet (Marquettage BDD)
– Maureen Denolf (Maquettage BDD)
– Louis Potdevin (MVC, Sécurité, POO)

# Structure MVC : 

L'ensemble de la structure MVC a été produite et pensée par Louis Potdevin dans son ensemble, incluant un ensemble de modules et de systèmes de routage qui ont été ou seront retravaillés dans le cadre du projet dit "CMS".
Le fonctionnement est le suivant : 
– Les controller font appel aux view ainsi qu'aux models permettant de traiter les données récupérées via les méthodes des différents models dont les données seront exploitées par les différentes parties view.
– La connexion à la base de données est initialisée dès le début du chargement du site afin d'y avoir accès durant toute la navigation.
– Le routeur gère les redirections en fonction des routes définies via la méthode routeMap() de la classe router.
Différents modules sont disponibles dans le but de faciliter le développement et de créer du code réutilisable, notamment pour le routeur, la gestion d'accès admin/user et la génération aléatoire d'identifiants via la méthode UUID Version 4.