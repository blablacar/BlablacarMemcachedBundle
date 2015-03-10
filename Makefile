.PHONY: install test clean

install:
	composer install

test:
	vendor/bin/phpunit

clean:
	vendor/bin/php-cs-fixer fix .
