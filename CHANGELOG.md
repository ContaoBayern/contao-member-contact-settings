# Contao Member Contact Settings change log


## 1.0.0

### Changed
* A hook is used to add "novalidate" attribute to member data form instead of using an own template (see #14)

### Fixed
* Fixed Bug which prohibited deactivation of saved contact settings in member data frontend module (see #22)


## 0.2.1

### New
* The extension can now be installed in a Contao 3.5.x Installation via composer-plugin (see #15)


## 0.2.0

### New
* Setting of mandatory status of dependet fields is now implemented in JavaScript, too (see #4)
* There are now two kinds of dependencies: "mandatory" and "visibility" (see #4)
* Dependent fields which are in the "visibility" array are shown/hidden in registration module via JavaScript (see #4)

### Changed
* The tl_member field "contactPost" was renamed to "contactLetter" (see #9)


## 0.1.0
Initial release
