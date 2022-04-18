CURRENT_DIR = $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
PCF_VERSION = 3-php7.4

.PHONY: phpcs-dry-run phpcs-fix

phpcs-dry-run:
	@echo "------------------------------------------------------------"
	@echo " PHP Code Style Fixer - Dry Run"
	@echo "------------------------------------------------------------"
	@if docker run --rm \
		-v $(CURRENT_DIR)/src:/data \
		cytopia/php-cs-fixer:$(PCF_VERSION) \
		fix --dry-run --diff .; then \
		echo "OK"; \
	else \
		echo "Failed"; \
		exit 1; \
	fi

phpcs-fix:
	@echo "------------------------------------------------------------"
	@echo " PHP Code Style Fixer"
	@echo "------------------------------------------------------------"
	@if docker run --rm \
		-v $(CURRENT_DIR)/src:/data \
		cytopia/php-cs-fixer:$(PCF_VERSION) \
		fix --diff .; then \
		echo "OK"; \
	else \
		echo "Failed"; \
		exit 1; \
	fi
