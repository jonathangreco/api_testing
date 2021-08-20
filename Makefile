.PHONY: start stopa2 stop migrate diff cc

STACK_NAME=php
php_container_id = $(shell docker ps --filter name="$(STACK_NAME)" -q)

clear-cache cc:
	bin/console cache:clear

start:
	docker-compose up -d

stopa2:
	sudo service apache2 stop && service mysql stop

stop:
	docker-compose down

migrate:
	bin/console doctrine:migrations:migrate

diff:
	bin/console doctrine:migrations:diff

bash: ## bash in the php (api) container
	docker exec -it $(php_container_id)  sh
