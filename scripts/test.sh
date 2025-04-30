# migrowanie bazy testowej
php artisan migrate:fresh --env=testing
php artisan migrate --env=testing

# odpalenie wszystkich testów w projekcie
php artisan test

# odpalenie pojedynczego pliku z testami
php artisan test --filter=AuthenticationTest

# weryfikacja migracji
php artisan migrate:status