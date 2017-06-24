<?php

// Register namespaces
ClassLoader::addNamespaces([
    'ContaoBayern',
]);

// Register classes
ClassLoader::addClasses([
    // Modules
    'ContaoBayern\MemberContactSettings\Modules\ModuleRegistration' => 'system/modules/member-contact-settings/modules/ModuleRegistration.php',
    'ContaoBayern\MemberContactSettings\Modules\ModulePersonalData' => 'system/modules/member-contact-settings/modules/ModulePersonalData.php',
    'ContaoBayern\MemberContactSettings\Classes\FieldDependencyManager' => 'system/modules/member-contact-settings/classes/FieldDependencyManager.php',
]);

// Register templates
TemplateLoader::addFiles([
    'member_default' => 'system/modules/member-contact-settings/templates/member',
]);
