composer create-project --prefer-dist laravel/laravel harkkatyo
php artisan make:auth
php artisan make:migration create_roles_and_permissions_tables --create=permissions
php artisan make:seeder UsersTableSeeder #modify database/seeds/userstableseeder & databaseseeder
#./.env -> MAIL_DRIVER:log MAIL_HOST:
php artisan make:seeder RolesAndPermissionsTableSeeder
php artisan make:model Role
php artisan make:model Permission
composer dump-autoload
mysql
create database harkkatyo;
#.env file: DB_DATABASE=harkkatyo DB_USERNAME=root DB_PASSWORD=
\q
php artisan migrate:refresh --seed
php artisan make:model Calendar -m
