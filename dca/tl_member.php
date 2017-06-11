<?php

/**
 * Member contact settings extension for Contao Open Source CMS.
 *
 * @copyright  Copyright (c) 2017 Contao Bayern
 * @author     Contao Bayern
 * @license    https://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 *
 * @see        https://github.com/ContaoBayern/contao-member-contact-settings
 */

// Modify default palette
$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace(
    'language;',
    'language;{contactSettings_legend},contactEmail,contactPost,contactPhone,contactFax;',
    $GLOBALS['TL_DCA']['tl_member']['palettes']['default']
);

// Add fields
$GLOBALS['TL_DCA']['tl_member']['fields']['contactEmail'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_member']['contactEmail'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => [
        'feEditable' => true,
        'feGroup' => 'contactSettings',
        'tl_class' => 'w50',
    ],
    'sql' => "char(1) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_member']['fields']['contactPost'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_member']['contactPost'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => [
        'feEditable' => true,
        'feGroup' => 'contactSettings',
        'tl_class' => 'w50',
    ],
    'sql' => "char(1) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_member']['fields']['contactPhone'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_member']['contactPhone'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => [
        'feEditable' => true,
        'feGroup' => 'contactSettings',
        'tl_class' => 'w50',
    ],
    'sql' => "char(1) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_member']['fields']['contactFax'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_member']['contactFax'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => [
        'feEditable' => true,
        'feGroup' => 'contactSettings',
        'tl_class' => 'w50',
    ],
    'sql' => "char(1) NOT NULL default ''",
];
