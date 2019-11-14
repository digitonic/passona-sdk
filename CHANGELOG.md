# Changelog

### v2.1.0 - 14th November 2019

### Added
- **Setters** - Built in setters are now available for all entities which can be referenced in the documentation.
- **Header Override** - The `setHeaders()` function is now available on all entities for swapping out headers as required.

### Changed
- **Responses** - Singular entities from requests such as `POST`, `PUT` and `GET` will now return a single entity and not a collection
containing a single entity.

### v2.0.0 - 11th November 2019
This release brings support for version 2 of the Passona API. Additionally, the SDK has been rewritten from the ground up to provide a more fluent interface.
