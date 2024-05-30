# Makefile for WordPress theme ppfeufer

# Default goal and help message for the Makefile
.DEFAULT_GOAL := help

# WP-CLI path information
wp_cli = vendor/bin/wp
wp_path = ./../../../../WP-Sources

# Theme information
theme_name = ppfeufer WordPress Theme
theme_slug = ppfeufer

# Create the theme .pot file
pot:
	@$(wp_cli) i18n make-pot \
		. \
		l10n/$(theme_slug).pot \
		--slug=$(theme_slug) \
		--domain=$(theme_slug) \
		--include="/"

# Clear all transient caches
clear-transient:
	@$(wp_cli) transient delete \
		--all \
		--path=$(wp_path)

# Activate the theme
activate:
	@$(wp_cli) theme activate \
		$(theme_name) \
		--path=$(wp_path)

# Deactivate the theme
deactivate:
	@$(wp_cli) theme deactivate \
		$(theme_name) \
		--path=$(wp_path)

# Run pre-commit checks
pre-commit-checks:
	@echo "Running pre-commit checks"
	@pre-commit run --all-files

# Update pre-commit configuration
pre-commit-update:
	@echo "Updating pre-commit configuration"
	@pre-commit autoupdate

# Help message for the Makefile
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
	@echo "  pre-commit-update  Update pre-commit configuration"
