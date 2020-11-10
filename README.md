**This document is for internal use only. It is confidential and the property of Webqam. It may not be reproduced or transmitted in whole or in part without the prior written consent of Webqam. / Ce document est à usage interne uniquement. Il est confidentiel et la propriété de Webqam. Il ne peut être reproduit ou transmis en tout ou partie sans l'accord préalable et écrit de Webqam.**

# Laravel Readme boilerplate

<p align="center">Place your customer logo here</p>

You are working on a laravel project, please follow instructions (More information: https://laravel.com/docs/6.x) :

## Summary

1. [About](#about)
2. [Server Requirements](#server-requirements)
3. Installation
    - [Main Structure](#main-structure)
    - [Commands to use on installation](#commands-to-use-on-installation)
4. Development
    - [Laravel development server](#laravel-development-server)
    - [Front](#front)
    - [Unit tests](#unit-tests)
    
## About
This project using Laravel 6.x (Name of the app/website) is an application for (Description of your app/website)

Gitlab repository : (url of your repository)[]
## Server Requirements

* PHP >= 7.3.16
* Nginx/Apache server
* MariaDB or MongoDB database
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* BCMath PHP Extension
* Composer
* Git

## Installation

### Main Structure
* Project input : `/public` 
* Configuration files : `/config`
* Resources files (assets) : `/resources`
* Core files : `/app`

For more detailed information about structure of a laravel root directory : https://laravel.com/docs/6.x/structure

### Commands to use on installation

* `cp .env.example .env` copy the default configuration file
* `chmod -R 777 ./storage/` give writing rights for storage directory 
* Fill .env file with your database credentials, APP_URL (with https if it's active)

| local        | pre-prod, staging or prod           
| ------------- |-------------  |
| `composer install` install php dependencies | `composer install --no-dev --no-progress -o` install php dependencies and exclude dev|
| `npm install` install npm dependencies      | Launched with gitlab CI job |   

* `php artisan key:generate` generate app key, answer 'yes'
* `php artisan config:clear` clear config cache
* `php artisan storage:link` create symbolic link for uploads
* `php artisan vendor:publish --tag=public` publish public assets to public folder
* `php artisan vendor:publish --provider="Backpack\CRUD\BackpackServiceProvider" --tag=minimum` publish public assets needed for Backpack BO

## Development 

### Laravel development server

To run Laravel development server, run `php artisan serve` (http://localhost:8000 will be default url of your app on your browser)

### Front

| local        | pre-prod, staging or prod           
| ------------- |-------------  |
| `npm run dev` compile assets files | `npm run prod` compile assets files, minify files, can launch custom actions |
| `npm run watch` watch assets files | do not watch anything in environment different of local

* `npm install -g stylelint` install css linter, to improve the style quality code
* `stylelint "path/to/your/css/**/*.scss"` launch stylelint for all your scss files

### Unit tests

Run the command `vendor/bin/phpunit` to launch tests.

They are located in /tests folder

### Linter

[GrumPHP](https://github.com/phpro/grumphp) and [Prettier](https://prettier.io/) are set in git hook to check code style (each commit).  

To fix some JS / CSS code style mistake this command can help you : `pretty-quick --staged`  
It's try to reformat staged code.  
PHPStorm Plugin : [Prettier](https://plugins.jetbrains.com/plugin/10456-prettier)

To fix some PHP code style mistake this command can help you : `./vendor/bin/phpcbf {you file or your directory}`  
PHPStorm Plugin : [Prettier](https://plugins.jetbrains.com/plugin/10456-prettier)
You can enable Code Sniffer in PHPStorm ([Doc](https://www.jetbrains.com/help/phpstorm/using-php-code-sniffer.html)) and set code style to [PHPStorm formater](https://laraveldaily.com/how-to-configure-phpstorm-for-psr-2/)

## Observations
> The original location of this document is : https://gitlab.webqam.fr/webqam/boilerplates/readme/blob/master/Laravel.md 

