export PROJECT_NAME := ai-resume
export CURRENT_PATH := $(shell pwd)
export BACK_CONTAINER := back
export FRONT_CONTAINER := vue


PHP_CS_FIXER_ARGS = --show-progress=dots --rules=@PSR12
DOCKER_COMPOSE=docker-compose -p ${PROJECT_NAME} -f ${CURRENT_PATH}/ops/docker/docker-compose.yml -f ${CURRENT_PATH}/ops/docker/docker-compose.dev.yml

restart: stop start

start: docker-build docker-up

start-no-cache: docker-build-no-cache docker-up

stop:
	@${DOCKER_COMPOSE} down --remove-orphans

docker-build:
	@${DOCKER_COMPOSE} build

docker-build-no-cache:
	@${DOCKER_COMPOSE} build --no-cache

docker-up:
	@${DOCKER_COMPOSE} up -d

logs:
	@${DOCKER_COMPOSE} logs -f

# COMPOSER

composer-install:
	@${DOCKER_COMPOSE} exec ${BACK_CONTAINER} composer install

composer-update:
	@${DOCKER_COMPOSE} exec ${BACK_CONTAINER} composer update

composer-require:
	@${DOCKER_COMPOSE} exec ${BACK_CONTAINER} composer require ${PACKAGE}

composer-require-dev:
	@${DOCKER_COMPOSE} exec ${BACK_CONTAINER} composer require --dev ${PACKAGE}

composer-remove:
	@${DOCKER_COMPOSE} exec ${BACK_CONTAINER} composer remove ${PACKAGE}

#tests and linting

lints-php:
	@${DOCKER_COMPOSE} exec ${BACK_CONTAINER} php vendor/bin/php-cs-fixer fix --config=.php_cs.dist --dry-run --diff --verbose $(PHP_CS_FIXER_ARGS)

lints-php-fix:
	@${DOCKER_COMPOSE} exec ${BACK_CONTAINER} php vendor/bin/php-cs-fixer fix --verbose $(PHP_CS_FIXER_ARGS)

tests-php:
	@${DOCKER_COMPOSE} exec ${BACK_CONTAINER} bin/phpunit

#yarn

yarn-add:
	@${DOCKER_COMPOSE} run ${FRONT_CONTAINER} yarn add ${PACKAGE}

# ui

open-ui:
	open http://localhost:5173

open-api:
	open http://localhost:8080/api

open-mongo-express:
	open http://localhost:8888

shell-frontend:
	@${DOCKER_COMPOSE_PROD} exec ${FRONT_CONTAINER} sh

shell-backend:
	@${DOCKER_COMPOSE_PROD} exec ${BACK_CONTAINER} bash

#embedding

update-embeddings:
	cd code/embedding \
	&& python3 embedding.py \
 	&& cp resume.json ../backend/src/AiResume/Infrastructure/Storage/Data/resume.json