# Advanced configuration

## All available configuration options
```make
PHP_APPLICATION_HOST         = 111.111.111.111 #address of host with php application deployed
PHP_APPLICATION_HOST_USER    = root #user to log in with ssh
PHP_APPLICATION_HOST_SSH_KEY = ~/.ssh/id_rsa #path to private ssh key
PHP_APPLICATION_CACHE_HOST   = 125.125.0.1 #redis-cache address in private network

REDIS_CACHE_HOST         = 222.222.222.222 #address of host with redis cache
REDIS_CACHE_HOST_USER    = root #user to log in with ssh
REDIS_CACHE_HOST_SSH_KEY = ~/.ssh/id_rsa #path to private ssh key

APPLICATION_URL = http://138.68.83.170 #address of php application (could be domain name as well)

GATLING_STRESS_TESTING_USER_LOW  = 1 #The initial number of a request per second
GATLING_STRESS_TESTING_USER_HIGH = 50 #The maximum number of a request per second
GATLING_STRESS_TESTING_DURATION  = 300 #The duration of stress-test
```

## Example configuration for `php-appliaction` and `redis-cache` deployed to single host
```make
PHP_APPLICATION_HOST         = 111.111.111.111
PHP_APPLICATION_HOST_USER    = root
PHP_APPLICATION_HOST_SSH_KEY = ~/.ssh/id_rsa
PHP_APPLICATION_CACHE_HOST   = 127.0.0.1 #redis-cache is on same host so private address of it will be localhost

REDIS_CACHE_HOST         = 111.111.111.111
REDIS_CACHE_HOST_USER    = root
REDIS_CACHE_HOST_SSH_KEY = ~/.ssh/id_rsa
```

## `Php-appliaction` and `redis-cache` deployed to two different host
```make
PHP_APPLICATION_HOST         = 111.111.111.111
PHP_APPLICATION_HOST_USER    = root
PHP_APPLICATION_HOST_SSH_KEY = ~/.ssh/id_rsa
PHP_APPLICATION_CACHE_HOST   = 125.125.0.1

REDIS_CACHE_HOST         = 222.222.222.222
REDIS_CACHE_HOST_USER    = root
REDIS_CACHE_HOST_SSH_KEY = ~/.ssh/id_rsa
```