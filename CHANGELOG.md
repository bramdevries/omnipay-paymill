# Changelog

## [1.0.1] - 2014-12-14
### Changed
- `$response->getData()` should now return the nested `data` array instead of the entire response (when available)

## [1.0.0] - 2014-10-21
### Added
- Added the authorize method to create a preauthorization.
- Added the capture method to use a preauthorization to pay.
- Added the purchase method to create a transaction from a token.
