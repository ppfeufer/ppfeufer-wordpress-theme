# Makefile for WordPress theme ppfeufer

# Default goal and help message for the Makefile
.DEFAULT_GOAL := help

# Theme information
theme_name = ppfeufer WordPress Theme
theme_slug = ppfeufer

# Help message for the Makefile
help::
	@echo "$(FONT_BOLD)$(theme_name)$(FONT_BOLD_END) Makefile"
	@echo ""
	@echo "$(FONT_BOLD)Usage:$(FONT_BOLD_END)"
	@echo "  make [command]"
	@echo ""
	@echo "$(FONT_BOLD)Commands:$(FONT_BOLD_END)"

# Include the configurations
include .make/conf.d/*.mk
