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
     *
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
     * Sets the dependent ("child") fields to be "mandatory" when the corresponding "parent" field
     * is selected (checkbox is checked).
     */
    protected function setFieldDependencies()
    {
        foreach ($GLOBALS['TL_DCA']['tl_member']['fields'] as $field => $fieldconfig) {
            if (!isset($fieldconfig['eval']['dependents']) {
                continue;
            }
            foreach ($fieldconfig['eval']['dependents'] as $dependentField)) {
                if (in_array($field, $this->editable) && \Input::post($field)) {
                    // Preserve orignal value (of mandatory) so we can reset it later
                    $this->originalFieldValues[$dependentField] = $GLOBALS['TL_DCA']['tl_member']['fields'][$dependentField]['eval']['mandatory'];

                    // Set field to be mandatory
                    $GLOBALS['TL_DCA']['tl_member']['fields'][$dependentField]['eval']['mandatory'] = true;
                }
            }
        }
    }

    /**
     * Resets the dca data to it's original values.
     */
    protected
    function resetDcaData()
    {
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
