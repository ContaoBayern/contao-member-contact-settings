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

// Modify registration palette
$GLOBALS['TL_DCA']['tl_module']['palettes']['registration'] = str_replace(
    'disableCaptcha;',
    'disableCaptcha;{fieldDependencySettings_legend},mcsUseJavaScript;',
    $GLOBALS['TL_DCA']['tl_module']['palettes']['registration']
);

// Modify personalData palette
$GLOBALS['TL_DCA']['tl_module']['palettes']['personalData'] = str_replace(
    'editable;',
    'editable;{fieldDependencySettings_legend},mcsUseJavaScript;',
    $GLOBALS['TL_DCA']['tl_module']['palettes']['personalData']
);

// Add subpallete
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'mcsUseJavaScript';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['mcsUseJavaScript'] = 'mcsToggleVisibility';

// Add fields
$GLOBALS['TL_DCA']['tl_module']['fields']['mcsUseJavaScript'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['mcsUseJavaScript'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => [
        'submitOnChange' => true
    ],
    'sql' => "char(1) NOT NULL default '1'",
];
$GLOBALS['TL_DCA']['tl_module']['fields']['mcsToggleVisibility'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['mcsToggleVisibility'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'sql' => "char(1) NOT NULL default '1'",
];
