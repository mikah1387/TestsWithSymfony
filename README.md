# TestsWithSymfony

les tests unitaires et fonctionnels et E2E sur une authentification avec Symfony .

## Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP 8.2 ou supérieur
- Composer
- Symfony CLI (facultatif mais recommandé)
- Une base de données (MySQL, PostgreSQL, etc.)

## Installation

1. Clonez le dépôt GitHub :

   ```bash
   git clone https://github.com/mikah1387/TestsWithSymfony
   ```

2. Accédez au répertoire du projet :

   ```bash
   cd TestsWithSymfony
   ```

3. Installez les dépendances du projet avec Composer :

   ```bash
   composer install
   ```

4. Configurez les variables d'environnement :

   Copiez le fichier `.env` pour créer un fichier `.env.local` et modifiez les paramètres de configuration de votre base de données et autres configurations nécessaires.

   ```bash
   cp .env .env.local
   ```

   Modifiez le fichier `.env.local` pour correspondre à votre configuration de base de données. Par exemple :

   ```ini
   DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
   ```

   Décommenter les deux lignes

   ```ini
   # APP_ENV=dev
   # APP_SECRET=131baeac035b97fc64f636523929b040
   ```

5. Créez la base de données et exécutez les migrations :

   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

## Lancer l'application

1. Lancez le serveur web Symfony :

   ```bash
   symfony server:start
   ```

   ```bash
   symfony serve -d
   ```

   Ou utilisez le serveur web intégré de PHP :

   ```bash
   php -S localhost:8000 -t public
   ```

2. Accédez à l'application dans votre navigateur web :

   ```
   http://localhost:8000
   ```

3. creér une base de donées de test et rajouter des utilisateurs.

4. lancer les tests :
   ```
   php bin/phpunit --testdox
   ```
