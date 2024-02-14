## Préambule

Le but de l'exercice est de manipuler les bases de symfony et de Bootstrap à partir de sources existantes (mais simples).  
Il est recommandé de ne pas y passer plus de deux ou trois heures.

### Vous trouverez dans ce repository 
* les sources de l'exercice, un Symfony 6.3 tout à fait basique
* un composer.phar pour pouvoir utiliser composer


### ⚠️ Pré-requis:
* PHP8.2 & les modules nécessaires (dont sqlite)
* de quoi lancer le serveur (recommandé: https://symfony.com/doc/current/setup/symfony_server.html)


## Installation:
```shell
php composer.phar install
php bin/console doctrine:schema:update --force 
symfony server:start
# ouvrir l'URL affichée dans le terminal
```


### Etat des lieux
* un CRUD basique a été mis en place avec l'utilitaire de Symfony
* il s'agit d'une Todolist avec des Todo (nom, détails, et complet OUI/NON)
* Bootstrap CSS est installé
* mais le site n’est pas encore très beau ni très pratique


### Pour le rendre plus utilisable, il faudrait...
1. modifier le header pour y mettre les liens Accueil & Nouvelle Todo uniquement
2. styliser un peu la page avec les composants de Bootstrap pour que ce soit plus présentable
3. ajouter un bouton dans la liste pour pouvoir compléter une TODO plus rapidement


### Et si on veut aller plus loin... (tâches bonus)
1. afficher au dessus de la liste des todos `[nombre de todos complétés] / [Nombre de todos total]`
2. mettre un petit message encourageant quand il reste moins de la moitié des todos à faire
3. ajouter un bouton pour supprimer toutes les todos complétées


##  ⚠️ Livrables attendus
les sources du projet terminé sous forme d'archive zip ou d'un lien vers un repository git  
un compte rendu sommaire (**maximum 1 page**):
* du temps passé dessus
* les tâches effectuées
* les tâches non effectuées, et pourquoi
* éventuellement, des problèmes rencontrés ou des questions


N’hésitez pas à revenir vers nous si vous repérez des coquilles.
Bon courage !
