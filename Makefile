ROOT_DIR ?= $(PWD)
USER_ID   = $(shell id -u)
GROUP_ID  = $(shell id -g)

DOCKER_BUILD_CONTEXT_DIR    = docker
PLATFORM_NETWORK            = platform_network
LOCAL_COMPOSER_HOME_DIR     = $(HOME)/.composer
CONTAINER_COMPOSER_HOME_DIR = /tmp/.composer

CACHE_CONTAINER   = cache
CACHE_PORT        = 6379
CACHE_EXPOSE_PORT = 6379

APPLICATION_CONTAINER   = application
APPLICATION_IMAGE       = application
APPLICATION_IMAGE_FILE  = docker/application_ubuntu_16_04.dockerfile
APPLICATION_PORT        = 8000
APPLICATION_EXPOSE_PORT = 8000
APPLICATION_LOCAL_DIR   = $(ROOT_DIR)/application

TEST_HOST_CONTAINER     = test-host
TEST_HOST_IMAGE         = test-host
TEST_HOST_IMAGE_FILE    = docker/test_host_ubuntu_16_04.dockerfile
TEST_HOST_PORT_1        = 22
TEST_HOST_EXPOSE_PORT_1 = 22
TEST_HOST_PORT_2        = 80
TEST_HOST_EXPOSE_PORT_2 = 8000

BUILD_DIR = ansible/build
REPOSITORY_DIR = $(BUILD_DIR)/repository
REPOSITORY_URL = git@github.com:lzakrzewski/aws-stress-test.git
PACKAGE_DIR = $(BUILD_DIR)/package

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

ssh_key_gen:
	-echo N | ssh-keygen -q -t rsa -N "" -f ansible/inventories/keys/id_rsa

test_host_build: ssh_key_gen
	docker build -t $(TEST_HOST_IMAGE) -f $(TEST_HOST_IMAGE_FILE) $(DOCKER_BUILD_CONTEXT_DIR)

test_host_up: SSH_KEY=`cat ansible/inventories/keys/id_rsa.pub`

test_host_up: test_host_build
	docker run --name $(TEST_HOST_CONTAINER) -h $(TEST_HOST_CONTAINER) --network $(PLATFORM_NETWORK) -p $(TEST_HOST_EXPOSE_PORT_1):$(TEST_HOST_PORT_1) -p $(TEST_HOST_EXPOSE_PORT_2):$(TEST_HOST_PORT_2) -d $(TEST_HOST_IMAGE)
	docker exec $(TEST_HOST_CONTAINER) /bin/bash -c "echo $(SSH_KEY) >> /root/.ssh/authorized_keys"

test_host_down:
	-docker rm -f $(TEST_HOST_CONTAINER)

build_package:
	rm -rf $(REPOSITORY_DIR)
	rm -rf $(PACKAGE_DIR)
	mkdir -p $(REPOSITORY_DIR)
	mkdir -p $(PACKAGE_DIR)
	git clone --depth 1 $(REPOSITORY_URL) $(REPOSITORY_DIR)
	tar --exclude-vcs-ignores --exclude-vcs --directory $(REPOSITORY_DIR)/application -czf $(PACKAGE_DIR)/application.tar.gz .

test_host_deploy: build_package
	ansible-playbook -i ansible/inventories/hosts -l test ansible/deployment.yml

test_infrastructure_up: \
	network_up \
	cache_up \
	test_host_up

test_infrastructure_down: \
	cache_down \
	test_host_down \
	network_down

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
