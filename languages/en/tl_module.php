<?php

/**
 * Member contact settings extension for Contao Open Source CMS.
 *
 * @copyright  Copyright (c) 2017 Contao Bayern
 * @author     Jörg Moldenhauer
 * @author     Andreas Fieger
 * @license    https://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 *
 * @see        https://github.com/ContaoBayern/contao-member-contact-settings
 */

// Legends
$GLOBALS['TL_LANG']['tl_module']['fieldDependencySettings_legend'] = 'Field-dependency-settings';

// Fields
$GLOBALS['TL_LANG']['tl_module']['mcsUseJavaScript'] = ['Control field dependencies with JavaScript', 'Enables client side setting of dependent fields\' mandatory status (jQuery must be activated in page layout).'];
$GLOBALS['TL_LANG']['tl_module']['mcsToggleVisibility'] = ['Toggle visibility of dependent fields', 'Hides dependent fields when they are not mandatory.'];
