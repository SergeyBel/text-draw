all: style static test


style:
	docker-compose exec console-draw vendor/bin/php-cs-fixer fix

static:
	docker-compose exec console-draw vendor/bin/phpstan analyze src -c phpstan.neon

test:
	docker-compose exec console-draw vendor/bin/phpunit tests --colors

composer:
	docker-compose exec console-draw composer install


