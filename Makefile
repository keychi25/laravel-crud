test:
	docker exec laravel-app vendor/bin/phpunit

migrate:
	docker exec laravel-app php artisan migrate

tinker:
	docker exec -it laravel-app php artisan tinker
