ENV_FILE = .env
# Détecter la commande Docker approprier souvent docker composee souvent docker-compose
DOCKER_COMPOSE := $(shell if command -v docker-compose > /dev/null 2>&1; then echo "docker-compose"; else echo "docker compose"; fi)

clear-cache:
	@$(DOCKER_COMPOSE) run --rm artisan optimize:clear

# run les migrations 
migrations:
	@$(DOCKER_COMPOSE) run --rm artisan migrate 

migrations-seed:
	@$(DOCKER_COMPOSE) run --rm artisan migrate
	@$(DOCKER_COMPOSE) run --rm artisan db:seed


# pour lancer le projet des le début avec toutes les commande dans lordre
build-start:
	@$(DOCKER_COMPOSE) up --build --force-recreate -d nginx
	@$(DOCKER_COMPOSE) run --rm composer install
	@make env-file
	@echo "génération de la clé d'application... "
	@$(DOCKER_COMPOSE) run --rm artisan key:generate
	@make flush-db
	@make migrations-seed
	@echo "l'api est prête à être utiliser..."

#refraichi la base de donnée et en met ajour le clé id client de passport 
refresh:
	@$(DOCKER_COMPOSE) run --rm artisan migrate:refresh


# nettoie la base de donnée et la rend vide
flush-db:
	@$(DOCKER_COMPOSE) run --rm artisan migrate:fresh

# creation du fichier .env s'il n'existe pas en ajoutant les configuration de BDD
env-file: 
	@if [ ! -f $(ENV_FILE) ]; then \
		cp $(ENV_EXAMPLE_FILE) $(ENV_FILE); \
		echo "\n# Database configuration" >> $(ENV_FILE); \
		echo "DB_CONNECTION=mysql" >> $(ENV_FILE); \
		echo "DB_HOST=mysql" >> $(ENV_FILE); \
		echo "DB_PORT=3306" >> $(ENV_FILE); \
		echo "DB_DATABASE=quizdevbdd" >> $(ENV_FILE); \
		echo "DB_USERNAME=homestead" >> $(ENV_FILE); \
		echo "DB_PASSWORD=secret" >> $(ENV_FILE); \
		echo "$(ENV_FILE) a été créer."; \
	else \
		echo "$(ENV_FILE) existe déjà."; \
	fi