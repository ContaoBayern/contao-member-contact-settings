# Contao Member Contact Settings

Member contact settings extension for Contao Open Source CMS


## Overview

This module enhances the core modules `Registration` and `MemberData` by adding fields that
control the allowed contact settings for the registered frontend user.

## Installation via Composer

Search package `contaobayern/contao-member-contact-settings` and install as usual.
For Contao 4.4.x use the Contao Manager to install the extension.


## Manual Installation

1. Download the files from the GitHub repository. Rename the folder to `member-contact-settings`
and save under `system/modules`.
2. Update your database and clear the internal cache.


## Please note

This module's Javascript will not work with table layouts (i.e. if  "Tableless layout" is
not checked in the module's definition). This applies to Contao 3 only, as Contao 4 only has
templates for tableless layouts.


## Setup

The setup is the same for both frontend modules (registration and member data):

1. Create a new frontend module of the type "registration" or "member data".
2. Define the form  as usual.
3. With the new fields you can add dependencies. For example if you add "contactPhone" the field
"phone" will become mandatory when the user checks "contactPhone". A list of all dependencies is given below.
4. Sort the field as you wish. It makes sense to put the dependent fields right below the field from which
they depend.


## New fields and dependencies in tl_member

| Field          | Dependencies  |
| -------------  | ------------- |
| contactLetter  | street, postal, city, country |
| contactPhone   | phone |
| contactFax     | fax   |


## Adding your own dependencies

Dependencies are defined in the `tl_member` DCA. In the `eval` array of each field which has dependencies
there is a new entry `dependents`:

```php
$GLOBALS['TL_DCA']['tl_member']['fields']['contactLetter'] = [
    // ...
    'eval' => [
        // ...
        'dependents' => [
            'mandatory' => ['street', 'postal', 'city', 'country'],
            'visibility' => ['street', 'postal', 'city', 'country'],
        ],
        // ...
    ]
]
```

The array `mandatory` contains the names of the fields which shall be set to mandatory when the parent
field is checked. The array `visibility` contains the names of the fields which shall be shown or hidden
according to the parent field.

You can add or modify dependencies in the `system\config\dcaconfig.php` file.

For example if you want to add `state` to the dependencies of `contactLetter`. You can do so by adding
the following code to `system\config\dcaconfig.php`:

```php
$GLOBALS['TL_DCA']['tl_member']['fields']['contactLetter']['eval']['dependents']['mandatory'][] = 'state';
$GLOBALS['TL_DCA']['tl_member']['fields']['contactLetter']['eval']['dependents']['visibility'][] = 'state';
```

You can also create new dependencies for your own fields wherever you need them:
```php
$GLOBALS['TL_DCA']['tl_member']['fields']['myCheckbox']['eval']['dependents'] = [
    'mandatory' => ['fieldA', 'fieldB', 'fieldC'],
    'visibility' => ['fieldA', 'fieldB', 'fieldC'],
];
```

Attention: a field which is mandatory by default should not be put in any dependents list. Otherwise
its mandatory status will be controlled by the parent field which is unwanted because the field should
always be mandatory.
