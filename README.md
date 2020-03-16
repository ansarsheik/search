## Search

Endpoint to search for a user by his lastname

### Requirements

- Composer
- Docker & Docker-compose

To install composer please follow the step from here https://getcomposer.org/download/

### Install


 ````
 # Git Clone this repo
 git clone https://github.com/ansarsheik/search.git
 cd search
 
 mv env.dist env
 # update .env with the required database details
 
 mv docker-compose.yml-dist docker-composer.yml
 ````


### Spin up the application using Docker

make sure docker is install in your machine

```
docker-compose up -d

# Require the dependencies with Composer
docker-compose exec vt-php-fpm composer install

# Install the migration files
docker-compose exec vt-php-fpm bin/console doctrine:migrations:migrate

# load some sample data
docker-compose exec vt-php-fpm php bin/console doctrine:fixtures:load
```

### Usage


Open search.html file and enter name to search 
ex: Cameron


### Testing
To run Integration and Unit tests
````
docker-compose exec vt-php-fpm bin/phpunit

````

### Credits
Ansar Sheik @ 2020