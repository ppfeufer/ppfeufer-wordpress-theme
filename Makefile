# Makefile for WordPress theme ppfeufer

# Default goal and help message for the Makefile
.DEFAULT_GOAL := help

wp_cli = /usr/local/bin/wp-cli
wp_path = ./../../../../WP-Sources

theme_name = ppfeufer WordPress Theme
theme_slug = ppfeufer

help:
	@echo "$(theme_name) Makefile"
	@echo ""
	@echo "Usage: make [command]"
	@echo ""
	@echo "Commands:"
	@echo "  activate           Activate the theme"
	@echo "  clear-transient    Clear all transient caches"
	@echo "  deactivate         Deactivate the theme"
	@echo "  pot                Create the theme .pot file"
	@echo "  pre-commit-checks  Run pre-commit checks"

pot:
	$(wp_cli) i18n make-pot \
		. \
		l10n/$(theme_slug).pot \
		--slug=$(theme_slug) \
		--domain=$(theme_slug) \
		--include="/"

clear-transient:
	$(wp_cli) transient delete \
		--all \
		--path=$(wp_path)

activate:
	$(wp_cli) theme activate \
		$(theme_name) \
		--path=$(wp_path)

deactivate:
	$(wp_cli) theme deactivate \
		$(theme_name) \
		--path=$(wp_path)

pre-commit-checks:
	@echo "Running pre-commit checks"
	pre-commit run --all-files
