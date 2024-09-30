# Documentation de l'API

Bienvenue dans la documentation de cette API REST. Suivez les instructions ci-dessous pour installer et démarrer le projet.

## Installation

Vous avez deux options pour installer ce projet :

1. **Installation avec Docker**
2. **Installation classique**

### 1. Installation avec Docker

Pour installer le projet via Docker, suivez ces étapes :

1. Clonez ou téléchargez le dépôt GitHub avec la commande suivante :

    ```bash
    git clone https://github.com/dani03/api_orange_restricted.git
    ```

2. Accédez au répertoire du projet, puis exécutez la commande suivante pour construire et démarrer les services :

    ```bash
    make build-start
    ```

    Cette commande effectuera les actions suivantes :

    - Recrée le serveur Nginx.
    - créer un fichier database.sqlite dans le dossier `database`
    - Installe les dépendances via Composer.
    - Crée un fichier `.env` basé sur le fichier `.env.exemple` et remplit les variables liées à la base de données (déclarées dans le fichier `docker-compose.yml` sous le service MySQL).
    - Génère la clé d'application avec `php artisan key:generate`.
    - créer un dossier `mysql` à la racine qui sera votre base de données.
    - Exécute les migrations et les seeders pour initialiser la base de données.

3. Une fois l'installation terminée, vous pouvez vérifier que l'API fonctionne en accédant à l'URL suivante :

    ```
    http://localhost:4000/api/test
    ```

4. Vous pouvez consulter la documentation complète de l'API à l'adresse suivante avec scramble :

```
http://localhost:4000/docs/api

```

5. Pour exécuter manuellement les migrations à l'intérieur du conteneur Docker, utilisez la commande suivante :
    ```bash
    docker compose run --rm artisan migrate
    ```
6. Pour exécuter dépendences à l'intérieur du conteneur Docker, utilisez la commande suivante :

    ```bash
    docker compose run --rm composer install
    ```
7. Accès à phpmyadmin sur le port 2023 : http://localhost:2023 

    Si vous rencontrez des problèmes
    effectuer les commandes suivantes :
    `docker compose run --rm artisan cache:clear`
    `docker compose run --rm artisan config:clear`
    `docker compose run --rm artisan optimze`

pour nettoyer le cache et les configurations supprimées

8. Pour stopper les containers taper la commande `docker compose down` vos données ne seront pas perdues. 

### 2. Installation classique

Pour une installation sans Docker, suivez ces étapes :

1.  Clonez ou téléchargez le dépôt GitHub avec la commande suivante :

    ```bash
    git clone https://github.com/dani03/api_orange_restricted.git
    ```

2.  Accédez au répertoire du projet et créez un fichier `.env` à la racine. Copiez-collez le contenu du fichier `.env.exemple` dans le nouveau fichier `.env`. Remplacez ensuite les informations de connexion à la base de données avec vos propres identifiants :

    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_11_api
    DB_USERNAME=root
    DB_PASSWORD=
    ```

3. Dans le dossier database situé à la racine du projet créer un fichier database.sqlite

4. lancer l'installation des dépendances avec la commande `composer install`

5. Générez la clé d'application avec la commande suivante :

    ```bash
    php artisan key:generate
    ```

6. dans votre SGBD (phpmyadmin, mysql workbench etc...) créer une base de données `laravel_11_api`
ce nom doit correspondre à la valeur de `DB_DATABASE`  situé dans le fichier `.env`
7. Lancez les migrations pour créer les tables dans la base de données :

    ```bash
    php artisan migrate
    ```

8. Si vous souhaitez remplir la base de données avec des données initiales, exécutez les seeders :

    ```bash
    php artisan db:seed
    ```

9. Pour démarrer le serveur localement, exécutez la commande suivante :

    ```bash
    php artisan serve --port 4000
    ```

10. Une fois les migrations et les seeders terminés, vous pouvez vérifier l'accès à l'API en accédant à l'URL suivante :

    ```
    http://localhost:4000/api/test
    ```

11. Votre projet sera accessible à l'adresse suivante :

        ```
        http://localhost:4000
        ```

        Vous pouvez consulter la documentation complète de l'API avec scrambble :

        ```
        http://localhost:4000/docs/api
        ```


Si vous rencontrez des problèmes
effectuer les commandes suivantes :
 ```
 php artisan cache:clear
 php artisan config:clear
 php artisan optimize
 ```

Cette documentation vous guide à travers l'installation et la configuration du projet.
