# We Movies Application
The "We Movies application" is a web application written in Symfony.

# Requirements
* PHP 8.1 or higher
# Installing
* Install dependencies Back
 * cd we_movies/
 * composer install
* Puts the file with the routes in the proper location

* php bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json
* Install dependencies Front
 * npm install
 * npm run dev
# Usage
* There's no need to configure anything to run the application. If you have installed Symfony binary, run this command:
 * cd we_movies/
 * symfony serve
* If you don't have the Symfony binary installed, run php -S localhost:8000 -t public/ to use the built-in PHP web server or configure a web server like Nginx or Apache to run the application.

# Tests
* Execute this command to run tests:
* ./bin/phpunit