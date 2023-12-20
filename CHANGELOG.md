# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

```yaml
## [tag] - YYYY-MM-DD
[tag]: https://github.com/velkuns/math/compare/1.1.0...master
### Changed
- Change 1
### Added
- Added 1
### Removed
- Remove 1
```

----

## [1.3.0] - 2023-12-20
[1.3.0]: https://github.com/velkuns/math/compare/1.1.0...1.2.0
### Changed
- `Vector2DDir::fromDirection()`:
  - Add `$invertX` boolean to allow inverting direction on x-axis 
  - Add `$invertY` boolean  to allow inverting direction on y-axis


## [1.2.0] - 2023-12-10
[1.2.0]: https://github.com/velkuns/math/compare/1.1.0...1.2.0
### Changed
- `Matrix::reverse()`: now, can reverse without preserving key
- `Matrix`: property `matrix` is now protected


## [1.1.0] - 2023-12-10
[1.1.0]: https://github.com/velkuns/math/compare/1.0.0...1.1.0
### Changed
- Matrix: 
  - Now return static rather that self to allow extension
  - Make constructor final to avoid any problem when extend the class
### Added
- Add Math class for GCD & LCM calculator

## [1.0.0] - 2023-12-01
### Changed
- Initialize repository
