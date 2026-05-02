help:
	@echo ""
	@echo "Article commands list"
	@echo ""
	@echo "Usage: make [COMMAND]"
	@echo ""
	@echo "phpcs: Check code style for whole project"
	@echo "phpcs-fix: Fix code style errors for whole project (not all errors can be fixed)"
	@echo "phpstan: Run static analyzer for whole project"
	@echo ""

phpcs:
	composer phpcs

phpcs-fix:
	composer phpcs-fix

phpstan:
	composer phpstan
