ROOT_DIR ?= $(PWD)
USER_ID   = $(shell id -u)
GROUP_ID  = $(shell id -g)

include $(ROOT_DIR)/config/config.makefile

DOCKER_BUILD_CONTEXT_DIR    = docker-containerization
PLATFORM_NETWORK            = platform_network
LOCAL_COMPOSER_HOME_DIR     = $(HOME)/.composer
CONTAINER_COMPOSER_HOME_DIR = /tmp/.composer

CACHE_CONTAINER   = cache
CACHE_PORT        = 6379
CACHE_EXPOSE_PORT = 6379

APPLICATION_URL ?= http://$(PHP_APPLICATION_HOST)

PHP_APPLICATION_HOST_SSH_KEY_PUBLIC  = $(PHP_APPLICATION_HOST_SSH_KEY).pub
PHP_APPLICATION_HOST_SSH_KEY_PRIVATE = $(PHP_APPLICATION_HOST_SSH_KEY)
PHP_APPLICATION_SSH_KEY_RAW          = $(shell cat $(PHP_APPLICATION_HOST_SSH_KEY_PUBLIC))
PHP_APPLICATION_CONTAINER            = php-application
PHP_APPLICATION_IMAGE                = php-application
PHP_APPLICATION_IMAGE_FILE           = docker-containerization/application_ubuntu_16_04.dockerfile
PHP_APPLICATION_PORT                 = 8001
PHP_APPLICATION_EXPOSE_PORT          = 8001
PHP_APPLICATION_LOCAL_DIR            = $(ROOT_DIR)/php-application

REDIS_CACHE_HOST_SSH_KEY_PUBLIC  = $(REDIS_CACHE_HOST_SSH_KEY).pub
REDIS_CACHE_HOST_SSH_KEY_PRIVATE = $(REDIS_CACHE_HOST_SSH_KEY)

TEST_HOST_CONTAINER     = test-host
TEST_HOST_IMAGE         = test-host
TEST_HOST_IMAGE_FILE    = docker-containerization/test_host_ubuntu_16_04.dockerfile
TEST_HOST_PORT_1        = 22
TEST_HOST_EXPOSE_PORT_1 = 22
TEST_HOST_PORT_2        = 80
TEST_HOST_EXPOSE_PORT_2 = 8000

GATLING_STRESS_TESTING_CONTAINER            = gatling-stress-testing
GATLING_STRESS_TESTING_IMAGE                = denvazh/gatling
GATLING_STRESS_TESTING_LOCAL_DIR            = $(ROOT_DIR)/gatling-stress-testing
GATLING_STRESS_TESTING_LOCAL_CONF           = $(GATLING_STRESS_TESTING_LOCAL_DIR)/conf
GATLING_STRESS_TESTING_CONTAINER_CONF       = /opt/gatling/conf
GATLING_STRESS_TESTING_LOCAL_USER_FILES     = $(GATLING_STRESS_TESTING_LOCAL_DIR)/user-files
GATLING_STRESS_TESTING_CONTAINER_USER_FILES = /opt/gatling/user-files
GATLING_STRESS_TESTING_LOCAL_RESULTS        = $(GATLING_STRESS_TESTING_LOCAL_DIR)/results
GATLING_STRESS_TESTING_CONTAINER_RESULTS    = /opt/gatling/results
GATLING_STRESS_TESTING_SIMULATION           = wall.PublishPostSimulation
GATLING_STRESS_TESTING_USER_LOW             ?= 1
GATLING_STRESS_TESTING_USER_HIGH            ?= 100
GATLING_STRESS_TESTING_DURATION             ?= 100

BUILD_DIR      = ansible-deployment/build
REPOSITORY_DIR = $(BUILD_DIR)/repository
REPOSITORY_URL = https://github.com/lzakrzewski/stress-testing-sandbox.git
PACKAGE_DIR    = $(BUILD_DIR)/package

network_up:
	docker network create --driver bridge --subnet 172.20.0.0/16 $(PLATFORM_NETWORK)

network_down:
	-docker network rm $(PLATFORM_NETWORK)

cache_up:
	docker run --name $(CACHE_CONTAINER) -h $(CACHE_CONTAINER) --network $(PLATFORM_NETWORK) -p $(CACHE_EXPOSE_PORT):$(CACHE_PORT) -d redis

cache_down:
	-docker rm -f $(CACHE_CONTAINER)

php_application_build:
	docker build -t $(PHP_APPLICATION_IMAGE) -f $(PHP_APPLICATION_IMAGE_FILE) $(DOCKER_BUILD_CONTEXT_DIR)

php_application_up: php_application_build
	docker run --name $(PHP_APPLICATION_CONTAINER) -h $(PHP_APPLICATION_CONTAINER) --network $(PLATFORM_NETWORK) -v $(LOCAL_COMPOSER_HOME_DIR):$(CONTAINER_COMPOSER_HOME_DIR) -v $(PHP_APPLICATION_LOCAL_DIR):/php-application -p $(PHP_APPLICATION_EXPOSE_PORT):$(PHP_APPLICATION_PORT) -d $(PHP_APPLICATION_IMAGE)
	docker exec --user $(USER_ID):$(GROUP_ID) $(PHP_APPLICATION_CONTAINER) composer install -n

test_php_application:
	docker exec --user $(USER_ID):$(GROUP_ID) $(PHP_APPLICATION_CONTAINER) composer test-ci

php_application_down:
	-docker rm -f $(PHP_APPLICATION_CONTAINER)

test_host_build:
	docker build --build-arg PHP_APPLICATION_SSH_KEY_RAW='$(PHP_APPLICATION_SSH_KEY_RAW)' -t $(TEST_HOST_IMAGE) -f $(TEST_HOST_IMAGE_FILE) $(DOCKER_BUILD_CONTEXT_DIR)

test_host_up: test_host_build
	docker run --name $(TEST_HOST_CONTAINER) -h $(TEST_HOST_CONTAINER) --network $(PLATFORM_NETWORK) -p $(TEST_HOST_EXPOSE_PORT_1):$(TEST_HOST_PORT_1) -p $(TEST_HOST_EXPOSE_PORT_2):$(TEST_HOST_PORT_2) -d $(TEST_HOST_IMAGE)

test_host_down:
	-docker rm -f $(TEST_HOST_CONTAINER)

build_package:
	rm -rf $(REPOSITORY_DIR)
	rm -rf $(PACKAGE_DIR)
	mkdir -p $(REPOSITORY_DIR)
	mkdir -p $(PACKAGE_DIR)
	git clone --depth 1 $(REPOSITORY_URL) $(REPOSITORY_DIR)
	tar --directory $(REPOSITORY_DIR)/php-application -czf $(PACKAGE_DIR)/php-application.tar.gz .

deploy_php_application: build_package
	ansible-playbook -i '$(PHP_APPLICATION_HOST),' -u $(PHP_APPLICATION_HOST_USER) --key-file=$(PHP_APPLICATION_HOST_SSH_KEY_PRIVATE) ansible-deployment/php-application-deployment.yml -e CACHE_HOST=$(PHP_APPLICATION_CACHE_HOST) --ssh-common-args="-o StrictHostKeyChecking=no -o BatchMode=yes"

deploy_redis_cache:
	ansible-playbook -i '$(REDIS_CACHE_HOST),' -u $(REDIS_CACHE_HOST_USER) --key-file=$(REDIS_CACHE_HOST_SSH_KEY_PRIVATE) ansible-deployment/redis-cache-deployment.yml --ssh-common-args="-o StrictHostKeyChecking=no -o BatchMode=yes"

deploy: \
	deploy_php_application \
	deploy_redis_cache

test_ansible_deployment: \
	deploy

run_stress_test:
	docker run --net="host" -it --rm --name $(GATLING_STRESS_TESTING_CONTAINER) -e DURATION=$(GATLING_STRESS_TESTING_DURATION) -e APPLICATION_URL=$(APPLICATION_URL) -e USERS_LOW=$(GATLING_STRESS_TESTING_USER_LOW) -e USERS_HIGH=$(GATLING_STRESS_TESTING_USER_HIGH) -v $(GATLING_STRESS_TESTING_LOCAL_CONF):$(GATLING_STRESS_TESTING_CONTAINER_CONF) -v $(GATLING_STRESS_TESTING_LOCAL_USER_FILES):$(GATLING_STRESS_TESTING_CONTAINER_USER_FILES) -v $(GATLING_STRESS_TESTING_LOCAL_RESULTS):$(GATLING_STRESS_TESTING_CONTAINER_RESULTS) $(GATLING_STRESS_TESTING_IMAGE) -s $(GATLING_STRESS_TESTING_SIMULATION)

test_gatling_stress_testing: \
	run_stress_test

platform_up: \
	network_up \
	cache_up \
	php_application_up \
	test_host_up

platform_down: \
	cache_down \
	php_application_down \
	test_host_down \
	network_down

test: \
	platform_up \
	test_php_application \
	test_ansible_deployment \
	test_gatling_stress_testing \
	platform_down \
