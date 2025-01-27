# Assos

plateforme de gestion d'association et tontine au cameroun

## Description

Assos est une plateforme de gestion destinée aux associations et tontines au Cameroun. Elle permet aux membres de gérer efficacement les activités de leur association, y compris les tontines, épargnes, et autres.

## Fonctionnalités Principales

- Gestion des membres
- Suivi des tontines
- Gestion des épargnes
- Création et gestion des prêts
- Génération de rapports financiers

## Installation

1. Clonez le dépôt :
   ```sh
   git clone https://github.com/gerazayisti/Assos.git
   ```
2. Accédez au répertoire du projet :
   ```sh
   cd Assos
   ```
3. Installez les dépendances PHP avec Composer :
   ```sh
   composer install
   ```
4. Copiez le fichier `.env.example` en `.env` et configurez vos variables d'environnement :
   ```sh
   cp .env.example .env
   ```
5. Générez la clé de l'application :
   ```sh
   php artisan key:generate
   ```
6. Configurez votre base de données dans le fichier `.env` et exécutez les migrations :
   ```sh
   php artisan migrate
   ```

## Utilisation

1. Démarrez le serveur de développement Laravel :
   ```sh
   php artisan serve
   ```
2. Accédez à l'application via `http://localhost:8000` dans votre navigateur.

## Contribuer

Les contributions sont les bienvenues. Pour commencer :

1. Forkez le dépôt.
2. Créez une branche pour votre fonctionnalité.
3. Faites vos modifications et committez-les.
4. Soumettez une pull request.

## Licence

Ce projet est sous licence MIT. Consultez le fichier [LICENSE](LICENSE) pour plus d'informations.

## Auteur

Frontend : Gervais Azanga Ayissi
Backend : Marc DAHA

Pour plus de détails, consultez les commits récents [ici](https://github.com/gerazayisti/Assos/commits/main).
