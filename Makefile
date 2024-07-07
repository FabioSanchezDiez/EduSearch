.PHONY: init
init: build up-d install-dependencies ## Runs everything needed to get the project ready from scratch

.PHONY: build
build: ## Build the containers
	sudo docker compose build

.PHONY: up
up: ## Start the containers
	sudo docker compose up

.PHONY: up-d
up-d: ## Start the containers in the background
	sudo docker compose up -d

.PHONY: stop
stop: ## Stop the containers
	sudo docker compose stop

.PHONY: db
db: ##Create the initial db
	sudo docker exec -it edusearch_api php bin/console doctrine:database:drop -n --if-exists --force
	sudo docker exec -it edusearch_api php bin/console doctrine:database:create -n --if-not-exists
	sudo docker exec -it edusearch_api php bin/console doctrine:migrations:migrate -n
	sudo docker exec -it edusearch_api php bin/console doctrine:fixtures:load -n

.PHONY: install-dependencies
install-dependencies: ##Install composer dependencies
	sudo docker exec -it edusearch_api composer install
	sudo docker exec -it edusearch_api php bin/console lexik:jwt:generate-keypair --skip-if-exists

.PHONY: tests
tests: db ##Run all unit tests
	sudo docker exec -it edusearch_api php bin/phpunit tests/