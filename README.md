# Waterdop Devtask

## Assumptions

- Dogs have a separate `name` field and a `data` field for the remaining data to make filtering possible.

## Prerequisites

### Already Installed:
- Docker 
- Docker Compose

## Installation

1. `cp .env.example .env`
2. ```
   docker run --rm \
   -u "$(id -u):$(id -g)" \
   -v "$(pwd):/var/www/html" \
   -w /var/www/html \
   laravelsail/php82-composer:latest \
   composer install --ignore-platform-reqs
   ```
3. `./vendor/bin/sail up -d`
4. `./vendor/bin/sail artisan key:generate`
5. `./vendor/bin/sail artisan migrate`
6. `./vendor/bin/sail artisan queue:work`
7. Navigate to the frontend directory in separate terminal: `cd frontend`
8. `npm install`
9. `npm run dev`

## Usage

1. Open localhost:8080 to display a list of dogs
2. Use the Postman collection to create or list dogs
3. Execute `./vendor/bin/sail artisan test` to execute the feature tests
