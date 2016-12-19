ROOT_DIR ?= $(PWD)

LOCAL_CONF           = $(ROOT_DIR)/conf
CONTAINER_CONF       = /opt/gatling/conf
LOCAL_USER_FILES     = $(ROOT_DIR)/user-files
CONTAINER_USER_FILES = /opt/gatling/user-files
LOCAL_RESULTS        = $(ROOT_DIR)/results
CONTAINER_RESULTS    = /opt/gatling/results

run-stress-tests:
	docker run --net="host" -it --rm -v $(LOCAL_CONF):$(CONTAINER_CONF) -v $(LOCAL_USER_FILES):$(CONTAINER_USER_FILES) -v $(LOCAL_RESULTS):$(CONTAINER_RESULTS) denvazh/gatling -s wall.PublishPostSimulation
