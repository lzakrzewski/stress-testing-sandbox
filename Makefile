CACHE_CONTAINER = cache

cache_up:
	docker run --name $(CACHE_CONTAINER) -h $(CACHE_CONTAINER) -p 6379:6379 -d redis

cache_down:
	-docker stop $(CACHE_CONTAINER)
	-docker rm $(CACHE_CONTAINER)

application_up: \
	cache_up
	cd application && composer install -n

application_down: \
	cache_down

test_ci: \
	application_up
	cd application && composer test-ci