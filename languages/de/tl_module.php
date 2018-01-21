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
$GLOBALS['TL_LANG']['tl_module']['fieldDependencySettings_legend'] = 'Abhängigkeits-Einstellungen';

// Fields
$GLOBALS['TL_LANG']['tl_module']['mcsUseJavaScript'] = ['Felder Abhängigkeiten per JavaScript steuern', 'Erlaubt das clientseitige setzen des Pflichfeld-Status von abhängigen Feldern (jQuery muss im Seitenlayout aktiviert sein).'];
$GLOBALS['TL_LANG']['tl_module']['mcsToggleVisibility'] = ['Sichtbarkeit der abhängigen Felder verändern', 'Versteckt abhängige Felder wenn sie keine Pflichtfelder sind.'];
