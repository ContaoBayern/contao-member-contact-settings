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

namespace ContaoBayern\MemberContactSettings\Modules;

class ModuleRegistration extends \ModuleRegistration
{
    /**
     * Original dca field values which are to be resetted when we are done
     * @var array
     */
    private $originalFieldValues;

    /**
     * Generate the module.
     */
    public function compile()
    {
        $this->loadDataContainer('tl_member');
        $this->setFieldDependencies();
        parent::compile();
        $this->resetDcaData();
    }

    /**
     * Sets certain fields to "mandatory" when the corresponding checkbox is checked.
     */
    protected function setFieldDependencies()
    {
        $dependencies = [
            'contactPhone' => ['phone'],
        ];


        foreach ($dependencies as $field => $dependentFields) {
            if ($this->Input->post($field)) {
                foreach ($dependentFields as $dependentField) {
                    // Preserve orignal value so we can reset it later
                    $this->originalFieldValues[$dependentField] = $GLOBALS['TL_DCA']['tl_member']['fields'][$dependentField]['eval']['mandatory'];

                    // Set field to mandatory
                    $GLOBALS['TL_DCA']['tl_member']['fields'][$dependentField]['eval']['mandatory'] = true;
                }
            }
        }
    }

    /**
     * Resets the dca data to it's original values
     */
    protected function resetDcaData() {
        if (!empty($this->originalFieldValues)) {
            foreach ($this->originalFieldValues as $field => $value) {
                if (is_null($value)) {
                    unset($GLOBALS['TL_DCA']['tl_member']['fields'][$field]['eval']['mandatory']);
                } else {
                    $GLOBALS['TL_DCA']['tl_member']['fields'][$field]['eval']['mandatory'] = $value;
                }
            }
        }
    }
}
