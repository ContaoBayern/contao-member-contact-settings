<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'ContaoBayern',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'ContaoBayern\MemberContactSettings\Modules\ModuleRegistration' => 'system/modules/member-contact-settings/modules/ModuleRegistration.php',
));
