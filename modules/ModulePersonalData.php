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

class ModulePersonalData extends \ModulePersonalData
{

    /**
     * Generate the module.
     */
    public function compile()
    {
        $fieldDependencyManager = new FieldDependencyManager($this->editable);
        $fieldDependencyManager->setFieldDependencies();
        parent::compile();
        $fieldDependencyManager->resetDcaData();
    }

}
