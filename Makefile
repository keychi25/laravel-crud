start:
	docker compose up --build

test:
	docker exec laravel-app vendor/bin/phpunit

test_coverage:
	docker exec laravel-app vendor/bin/phpunit --coverage-html coverage

migrate:
	docker exec laravel-app php artisan migrate

tinker:
	docker exec -it laravel-app php artisan tinker
