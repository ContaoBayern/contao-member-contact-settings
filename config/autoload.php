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
    'ContaoBayern\MemberContactSettings\Classes\TemplateModifier' => 'system/modules/member-contact-settings/classes/TemplateModifier.php',
]);

// Register templates
TemplateLoader::addFiles([
    'jquery_field_dependencies' => 'system/modules/member-contact-settings/templates/jquery',
]);
