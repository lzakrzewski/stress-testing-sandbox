test_ci:
	cd application && composer install
	cd application && composer test-ci