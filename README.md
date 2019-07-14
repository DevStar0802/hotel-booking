# Backend Installation

after cloning the project you should go inside the folder /backend-laravel then you can make the following steps

```bash
composer install
composer dump-autoload
```
this will install the laravel project, also you must make a copy of .env.example and rename it with just .env
inside you have to set you database credentials.

Now you are ready to migrate the database with the following commands.

```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan passport:install
```

when you backend is running open another console and go to frontend-vue folder and run.

```bash
npm install
npm run serve
```

you are now able to run the project at http://localhost:8080
