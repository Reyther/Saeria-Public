# DOCKER

## Startup

1. Create `.cloud/docker` directory in your project with this boilerplate

## Usage

1. Create `.env` with `.env.example`  
    ```bash
    cp .env.example .env
    ```

2. Complete `.env`  
**DEFAULT CONFIGURATION** block don't need to be updated 

3. Start container

**Production mode**
```bash
docker-compose up -d
```

**Local mode**
```bash
docker-compose -f docker-compose.yml -f docker-compose.local.yml up -d
```

**Local mode with exposed ports**
```bash
docker-compose -f docker-compose.yml -f docker-compose.local.yml -f docker-compose.expose.yml up -d
```

## Help command
Stop all containers
```
docker-compose down
```

Connect to SSH
```
docker-compose exec workspace bash  
> npm run dev
> composer install
> php artisan cache:clear
> ...
```

Show logs  
```
docker-compose logs -f {container-name}
docker-compose logs -f php-apache
```
Or go on `./logs/apache2/` directory

## Services  
* adminer in `8080` port (see .env)
* PHPMyAdmin in `8081` port (see .env)
* MailDev in `1080` port (see .env)

## Makefile

Makefile contain some helpful command.

- `make up` to start all container
- `make down` to down all container
- `make bash` to start all container and connect to `workspace` container
- `make up-expose` to start all container with exposed port
- `make down-expose` to down all container with exposed port
- `make bash-expose` to start all container and connect to `workspace` container with exposed port
- `make help` for help !

## Laravel & Write accesses

To allow write accesses to log files, add `'permission' => 0664` to your `config/logging.php` channel.

Example :
```php
return [
    // ...

    'channels' => [
        // ...

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
            'days' => 14,
            'permission' => 0664,
        ],

        // ...
    ],
];
```
