all: style static test


style:
	docker-compose exec text-draw vendor/bin/php-cs-fixer fix

static:
	docker-compose exec text-draw vendor/bin/phpstan analyze src -c phpstan.neon

test:
	docker-compose exec text-draw vendor/bin/phpunit tests --colors

composer:
	docker-compose exec text-draw composer install


