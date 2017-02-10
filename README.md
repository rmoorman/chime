# chime

chime is a social network in the form of a RESTful API. Currently under development, use at your own risk!

There is a running instance of chime you can play with @ https://chime.social

## Developing

1. First, clone the repo:

`git clone TBD`

2. Make sure you have a MySQL instance running, then navigate to the root directory of the project and enter the `mysql` CLI tool and run:

`source app/schema.sql`

This will create the needed database + tables for you.

3. Make sure you have [Composer](https://getcomposer.org/) installed, then from the root directory of the project, run:

`composer install`

4. Next, open up `/config/database.php` and `/config/jwt.php` to update your database + secret key settings. 

5. Once the settings are updated, start the app from the root directory using PHP's built-in server with:

`php -S 0.0.0.0:8080 -t public public/index.php`

This will run an instance of the API on Port 8080. Navigate to http://0.0.0.0:8080 to view the API documentation and get started.

## Running on Production

It is recommended that for production purposes, you run PHP-FPM with a reverse proxy such as Nginx in front of it.
