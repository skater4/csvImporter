.PHONY: up down build serve migrate clearcache

up:
	docker-compose config -q && \
	docker-compose up -d --force-recreate

down:
	docker-compose config -q && \
	docker-compose down --remove-orphans

reboot:
	make down && make up

build:
	docker-compose config -q && \
	docker-compose build --pull

rebuild:
	make down && make build && make up

composer-install:
	docker-compose config -q && \
	docker-compose exec laravel composer install

composer-update:
	docker-compose config -q && \
	docker-compose exec laravel composer update

composer-dump:
	docker-compose config -q && \
	docker-compose exec laravel composer dump-autoload -o