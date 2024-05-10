# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

<!--
GitHub MD Syntax:
https://docs.github.com/en/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax

Highlighting:
https://docs.github.com/assets/cb-41128/mw-1440/images/help/writing/alerts-rendered.webp

> [!NOTE]
> Highlights information that users should take into account, even when skimming.

> [!IMPORTANT]
> Crucial information necessary for users to succeed.

> [!WARNING]
> Critical content demanding immediate user attention due to potential risks.
-->

## \[In Development\] – Unreleased

<!--
Section Order:

### Added
### Fixed
### Changed
### Deprecated
### Removed
### Security
-->

### Added

- Text domain to the theme for translations

### Changed

- `package-lock.json` file updated
- Some minor code style improvements

## \[1.2.1\] - 2024-04-13

### Changed

- Autoloading refactored

## \[1.2.0\] - 2024-04-09

### Added

- Meta description tag to the header

### Fixed

- CSS formatting

## \[1.1.0\] - 2024-03-02

### Added

- `YahnisElsts/PluginUpdateChecker` to check for updates of the theme

## \[1.0.1\] - 2024-03-01

### Fixed

- Footer now again is at the bottom when the content is not large enough to push it down

## \[1.0.0\] - 2024-02-28

### Added

- PHP code style linting

### Changed

- Switched ESLint to their new flat configuration
- Using classes instead of `funcions.php` now

## \[0.1.0\] - 2023-12-11

### Added

- Native lazy-loading support for images

### Changed

- Favicons updated

## \[0.0.23\] - 2023-11-07

### Added

- SVG sprite for "Copy to Clipboard" button
- Argument keywords in PHP code

### Changed

- CSS moved to the dedicated `Assets` directory
- Favicons moved to the dedicated `Assets` directory
- JavaScript moved to the dedicated `Assets` directory
- PHP code formatted

## \[0.0.22\] - 2023-07-20

### Added

- Copy to clipboard button for code blocks

## \[0.0.21\] - 2023-06-04

### Changed

- Meta-tags are now generated via their own function

## \[0.0.20\] - 2022-11-08

### Removed

- Custom `:hover` color for links
- Unnecessary and non-existent 4th parameter from function

## \[0.0.19\] - 2022-10-05

### Changed

- Simplified `remove_protocol_from_url` function

## \[0.0.18\] - 2022-09-25

### Removed

- DNS prefetch

## \[0.0.17\] - 2022-09-13

### Added

- Missing margin on an arrow in a `::before` CSS rules

### Changed

- CSS lint applied

## \[0.0.16\] - 2022-08-28

### Fixed

- Site brand icon geometry

### Added

- Twitter cards to OG tags

## \[0.0.15\] - 2022-08-18

### Changed

- OG tags improved

## \[0.0.14\] - 2022-08-16

### Added

- Use article images as `og:image` meta tag

## \[0.0.13\] - 2022-08-10

### Fixed

- Make sure SVG images always use the full space they have

## \[0.0.12\] - 2022-08-10

### Changed

- Link colours when focused

## \[0.0.11\] - 2022-07-29

### Changed

- Use a template override to hide page title on the home page instead of CSS (This is the WordPress way)

## \[0.0.10\] - 2022-07-28

### Added

- Opaque blur effect to top navigation when page is scrolled
- Shortcode name for WP internal filter

### Fixed

- Better way of hiding the page title on the home page
- Argument type in shortcode class

## \[0.0.9\] - 2022-07-27

### Added

- Typehints to the PHP code
- `CHANGELOG.md` file
- `CODEOWNERS` file

## \[0.0.8\] - 2022-07-23

### Added

- CSS variables

### Fixed

- Style for `SyntaxHighlighter Evolved`

## \[0.0.7\] - 2022-07-05

### Removed

- `Website` field from comment form (You don't get to link spam on my website dear "SEOs")

### Changed

- Switched from `Codecolorer` to `SyntaxHighlighter Evolved` as syntax plugin

## \[0.0.6\] - 2022-05-21

### Added

- Shortcodes plugin

### Removed

- Footer inherited from parent theme

## \[0.0.5\] - 2022-05-15

### Changed

- The Primary sidebar is now sticky

## \[0.0.4\] - 2022-05-13

### Changed

- Style for `Codecolorer` elements

## \[0.0.3\] - 2022-04-29

### Added

- Plugin related stylesheet

## \[0.0.2\] - 2022-04-28

### Added

- Favicons
- Sticky footer when page not long enough
- [Fira Code](https://github.com/tonsky/FiraCode) as font for `code` blocks
- Theme version to CSS enqueues

### Removed

- Header title from `Home` page (via CSS only, so it only works on my website for now)
- Link outline style from parent theme

### Fixed

- Wrong redirect to favicon (thx WordPress, you suck at this)

## \[0.0.1\] - 2022-03-22

### Added

- README file
- LICENSE file

### Changed

- Switched from development on my own to a child theme of `WP-Moose` theme
