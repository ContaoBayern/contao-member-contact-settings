# Contao Member Contact Settings

Member contact settings extension for Contao Open Source CMS


## Overview

This module enhances the core modules `Registration` and `MemberData`. Note: for now only 
server side validation is implemented. Standard browser validation is deactivated and
JavaScript validation will be implemented in a future release.


## Manual Installation

1. Download the files from the GitHub repository. Rename the folder to `member-contact-settings` 
and save under `system/modules`.
2. Update your database and clear the internal cache.


## Setup

The setup is the same for both frontend modules (registration and member data):

1. Create a new frontend module of the type "registration" or "member data".
2. Select your needed fields as usual.
3. With the new fields you can add dependencies. For example if you add "contactPhone" the field
"phone" will become mandatory when the user checks "contactPhone". A list of all dependencies is given below.
4. Sort the field as you wish. It makes sense to put the dependent fields right below the field from which
they depend.


## New fields and dependencies in tl_member

| Field          | Dependencies  |
| -------------  | ------------- |
| contactEmail   | email | 
| contactPost    | street, postal, city, country |
| contactPhone   | phone |
| contactFax     | fax   |
