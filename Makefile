# Change these variables to match your environment
theme_name = ppfeufer

pot:
	./vendor/bin/wp i18n make-pot \
		. \
		l10n/$(theme_name).pot \
		--slug=$(theme_name) \
		--domain=$(theme_name) \
		--include="/"

clear-transient:
	./vendor/bin/wp transient delete \
		--all \
		--path=./../../../../Sources
