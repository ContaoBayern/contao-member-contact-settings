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

/**
 * Frontend modules.
 */
$GLOBALS['FE_MOD']['user']['registration'] = 'ContaoBayern\MemberContactSettings\Modules\ModuleRegistration';
$GLOBALS['FE_MOD']['user']['personalData'] = 'ContaoBayern\MemberContactSettings\Modules\ModulePersonalData';

/**
 * Hooks.
 */
$GLOBALS['TL_HOOKS']['parseFrontendTemplate'][] = ['ContaoBayern\MemberContactSettings\Classes\TemplateModifier', 'modifyFrontendTemplate'];
