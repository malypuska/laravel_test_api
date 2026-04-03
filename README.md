## Установка

перейти в папку где будет разворачиваться проект
выполнить в консоле
git clone https://github.com/malypuska/test_laravel_test_api.git ./

перейти в корень проекта
выпонить в консоле
composer install

Создайте БД

В файле .env пропишите подключение к БД

выпонить в консоле
php artisan migrate

Сервис готов к использованию

## Swagger/OpenAPI документация
выпонить в консоле
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"

В файле .env пропишите
L5_SWAGGER_GENERATE_ALWAYS=true
L5_SWAGGER_CONST_HOST=http://domain

выпонить в консоле
php artisan l5-swagger:generate
