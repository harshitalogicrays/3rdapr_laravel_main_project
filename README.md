how to run the code -

open terminal from your project location
cp .env.example .env
open .env file and update database and mail configuration
run - composer install
run - php artisan key:generate
run - php artisan migrate:fresh --seed
run - php artisan serve
