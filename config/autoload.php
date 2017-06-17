<?php

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces([
    'ContaoBayern',
]);


/**
 * Register the classes
 */
ClassLoader::addClasses([
    // Modules
    'ContaoBayern\MemberContactSettings\Modules\ModuleRegistration' => 'system/modules/member-contact-settings/modules/ModuleRegistration.php',
]);

TemplateLoader::addFiles([
    'member_default' => 'system/modules/member-contact-settings/templates/member',
]);