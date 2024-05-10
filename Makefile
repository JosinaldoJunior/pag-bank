up: ## Up containers
	docker compose up --build -d

install: ## Composer install
	docker exec -it pag-bank-app composer install

migrate: ## Run migrate
	docker exec -it pag-bank-app php artisan migrate --seed

test: ## Run tests
	docker exec -it pag-bank-app php artisan test

migrate-fresh: ## Run migrate
	docker exec -it pag-bank-app php artisan migrate:fresh --seed
