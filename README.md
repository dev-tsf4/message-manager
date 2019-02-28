# Présentation

![](doc/screenshot.jpg)

## Contexte

Test technique de recrutement.

> Mettre en place un formulaire de contact sur le site.
> Seul un utilisateur (adhérent) connecté pourra envoyer un message.
> L'adhérent et l'admin pourront accéder à la page contact.
> Réalisation d'un dashboard pour permettre à l'administrateur de traiter (marquer comme lu/non lu) les messages.
> Trier les messages du plus récent au plus ancien.
> Seul l'admin aura accès au dashboard.


## Requirements
* PHP >= 7.1
* MySQL >= 5.7

## Installation du projet dans votre environnement local
Cloner le projet.

```
git clone https://github.com/dev-tsf4/message-manager.git
```

Accéder au répertoire du projet, récupérer les dépendances avec composer.

```
composer install
```

Editer le fichier .env à la racine du projet et changer les paramètres d'accès à votre base de données. 

```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```
Construire la base de données
```
php bin/console doctrine:database:create
```
Construire le schéma (tables, charger les fixtures)
```
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
```
Lancer le serveur
```
php bin/console server:run
```

## Website

### Utilisateurs
  
| Email        | Password           | Roles  |
| --- |---| ---|
| admin@mail.com      | admin | ROLE_ADMIN_DASHBOARD |
| adherent@mail.com      | secret123      |   ROLE_USER |

### Liste des URLs

- http://127.0.0.1:8000/ #Redirection vers la page login
- http://127.0.0.1:8000/login 
- http://127.0.0.1:8000/contact #ROLE_ADMIN_DASHBOARD & ROLE_USER
- http://127.0.0.1:8000/dashboard #ROLE_ADMIN_DASHBOARD

## Todo

- Customiser page 404, 403
- Terminer boite modal du profile
- ...