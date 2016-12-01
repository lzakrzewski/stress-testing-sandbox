ROOT_DIR ?= $(PWD)
USER_ID   = $(shell id -u)
GROUP_ID  = $(shell id -g)

DOCKER_BUILD_CONTEXT_DIR     = docker
PLATFORM_NETWORK             = platform_network
LOCAL_COMPOSER_HOME_DIR      = $(HOME)/.composer
CONTAINER_COMPOSER_HOME_DIR  = /tmp/.composer

CACHE_CONTAINER          = cache
CACHE_PORT               = 6379
CACHE_EXPOSE_PORT        = 6379

APPLICATION_CONTAINER    = application
APPLICATION_IMAGE        = application
APPLICATION_IMAGE_FILE   = docker/application_ubuntu_16_04.dockerfile
APPLICATION_PORT         = 8000
APPLICATION_EXPOSE_PORT  = 8000
APPLICATION_LOCAL_DIR    = $(ROOT_DIR)/application

network_up:
	docker network create --driver bridge --subnet 172.20.0.0/16 $(PLATFORM_NETWORK)

network_down:
	-docker network rm $(PLATFORM_NETWORK)

cache_up:
	docker run --name $(CACHE_CONTAINER) -h $(CACHE_CONTAINER) --network $(PLATFORM_NETWORK) -p $(CACHE_EXPOSE_PORT):$(CACHE_PORT) -d redis

cache_down:
	-docker rm -f $(CACHE_CONTAINER)

application_build:
	docker build -t $(APPLICATION_IMAGE) -f $(APPLICATION_IMAGE_FILE) $(DOCKER_BUILD_CONTEXT_DIR)

application_up: application_build
	docker run --name $(APPLICATION_CONTAINER) -h $(APPLICATION_CONTAINER) --network $(PLATFORM_NETWORK) -v $(LOCAL_COMPOSER_HOME_DIR):$(CONTAINER_COMPOSER_HOME_DIR) -v $(APPLICATION_LOCAL_DIR):/application -p $(APPLICATION_EXPOSE_PORT):$(APPLICATION_PORT) -d $(APPLICATION_IMAGE)
	docker exec --user $(USER_ID):$(GROUP_ID) $(APPLICATION_CONTAINER) composer install -n

application_down:
	-docker rm -f $(APPLICATION_CONTAINER)

platform_up: \
	network_up \
	cache_up \
	application_up

platform_down: \
	cache_down \
	application_down \
	network_down

test_ci: \
	platform_up
	docker exec --user $(USER_ID):$(GROUP_ID) $(APPLICATION_CONTAINER) composer test-ci