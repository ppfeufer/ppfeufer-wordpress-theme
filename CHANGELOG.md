# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).


## [In Development] - Unreleased


### [0.0.19] - 2022-10-05

### Changed

- Simplified `remove_protocol_from_url` function


### [0.0.18] - 2022-09-25

### Removed

- DNS prefetch


### [0.0.17] - 2022-09-13

### Added

- Missing margin on an arrow in a `::before` CSS rules

### Changed

- CSS lint applied


### [0.0.16] - 2022-08-28

### Fixed

- Site brand icon geometry

### Added

- Twitter cards to OG tags


### [0.0.15] - 2022-08-18

### Changed

- OG tags improved


### [0.0.14] - 2022-08-16

### Added

- Use article images as `og:image` meta tag


### [0.0.13] - 2022-08-10

### Fixed

- Make sure SVG images always use the full space they have


### [0.0.12] - 2022-08-10

### Changed

- Link colours when focused


### [0.0.11] - 2022-07-29

### Changed

- Use a template override to hide page title on the home page instead of CSS (This is the WordPress way)


### [0.0.10] - 2022-07-28

### Added

- Opaque blur effect to top navigation when page is scrolled
- Shortcode name for WP internal filter

### Fixed

- Better way of hiding the page title on the home page
- Argument type in shortcode class


### [0.0.9] - 2022-07-27

### Added

- Typehints to the PHP code
- `CHANGELOG.md` file
- `CODEOWNERS` file


### [0.0.8] - 2022-07-23

### Added

- CSS variables

### Fixed

- Style for `SyntaxHighlighter Evolved`


### [0.0.7] - 2022-07-05

### Removed

- `Website` field from comment form (You don't get to link spam on my website dear "SEOs")

### Changed

- Switched from `Codecolorer` to `SyntaxHighlighter Evolved` as syntax plugin


### [0.0.6] - 2022-05-21

### Added

- Shortcodes plugin

### Removed

- Footer inherited from parent theme


### [0.0.5] - 2022-05-15

### Changed

- Primary sidebar is now sticky


### [0.0.4] - 2022-05-13

### Changed

- Style for `Codecolorer` elements


### [0.0.3] - 2022-04-29

### Added

- Plugin related stylesheet


### [0.0.2] - 2022-04-28

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


## [0.0.1] - 2022-03-22

### Added

- README file
- LICENSE file

### Changed

- Switched from development on my own to a child theme of ``WP-Moose`` theme
