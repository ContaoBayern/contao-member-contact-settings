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

namespace ContaoBayern\MemberContactSettings\Modules;

use ContaoBayern\MemberContactSettings\Classes\FieldDependencyManager;

class ModuleRegistration extends \ModuleRegistration
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplateJquery = 'jquery_field_dependencies';

    /**
     * Generate the module.
     */
    public function compile()
    {
        $fieldDependencyManager = new FieldDependencyManager($this->editable);

        $fieldDependencyManager->setMandatoryFieldDependencies();
        parent::compile();
        $fieldDependencyManager->resetDcaData();

        if ($this->mcsUseJavaScript) {
            $objTemplateJquery = new \FrontendTemplate($this->strTemplateJquery);
            $objTemplateJquery->formId = $this->Template->formId;
            $objTemplateJquery->dependencies = $fieldDependencyManager->getDependenciesJson();
            $objTemplateJquery->mandatoryHintText = $GLOBALS['TL_LANG']['MSC']['mandatory'];
            $objTemplateJquery->toggleVisibility = json_encode((bool) $this->mcsToggleVisibility);
            $GLOBALS['TL_JQUERY'][] = $objTemplateJquery->parse();
        }
    }
}
