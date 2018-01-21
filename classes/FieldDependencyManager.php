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

namespace ContaoBayern\MemberContactSettings\Classes;

class FieldDependencyManager
{
    /**
     * The names of the editable fields we handle.
     *
     * @var array
     */
    private $editable;

    /**
     * The dependencies of the editabel fields (created from dca data).
     *
     * @var array
     */
    private $dependencies;

    /**
     * Original dca field values which are to be resetted when we are done.
     *
     * @var array
     */
    private $originalFieldValues;

    /**
     * FieldDependencyManager constructor.
     *
     * @param $fieldnames array The names of the editable fields we handle
     */
    public function __construct($fieldnames)
    {
        $this->editable = $fieldnames;
        \Controller::loadDataContainer('tl_member');
        $this->initializeDependencies();
    }

    /**
     * Returns the depencies as JSON data.
     *
     * @return string The JSON encoded dependencies
     */
    public function getDependenciesJson()
    {
        return json_encode($this->dependencies);
    }

    /**
     * Sets the dependent ("child") fields to be "mandatory" when the corresponding "parent" field
     * is selected (checkbox is checked).
     */
    public function setMandatoryFieldDependencies()
    {
        if (!empty($this->dependencies)) {
            foreach ($this->dependencies as $field => $dependentFields) {
                if (\Input::post($field)) {
                    foreach ($dependentFields['mandatory'] as $dependentField) {
                        // Preserve orignal state of dependent field's mandatory setting so we can reset it later
                        $this->originalFieldValues[$dependentField] = $GLOBALS['TL_DCA']['tl_member']['fields'][$dependentField]['eval']['mandatory'];

                        // Set field to be mandatory
                        $GLOBALS['TL_DCA']['tl_member']['fields'][$dependentField]['eval']['mandatory'] = true;
                    }
                }
            }
        }
    }

    /**
     * Resets the dca data to it's original values.
     */
    public function resetDcaData()
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

    /**
     * Initializes dependencies based on editable fields and dca data.
     */
    private function initializeDependencies()
    {
        $this->dependencies = [];
        foreach ($this->editable as $field) {
            $dependents = $GLOBALS['TL_DCA']['tl_member']['fields'][$field]['eval']['dependents'];
            if (!isset($dependents) || !is_array($dependents)) {
                continue;
            }

            // Only handle fields which are actually used by the frontend module
            // and are not mandatory by default
            $dependents = [
                'mandatory' => $this->filterDependents($dependents['mandatory']),
                'visibility' => $this->filterDependents($dependents['visibility']),
            ];

            // Skip fields with empty dependents
            if (empty($dependents['mandatory']) || empty($dependents['visibility'])) {
                continue;
            }

            $this->dependencies[$field] = $dependents;
        }
    }

    /**
     * Removes fields which are not used by the frontend module
     * or are mandatory by default.
     *
     * @param array $fields The fields to filter
     *
     * @return array An array containing only fields which are used by
     *               the frontend module and are not mandatory by default
     */
    private function filterDependents($fields)
    {
        $fields = array_intersect($fields, $this->editable);
        $fields = array_filter($fields, function ($field) {
            return !$GLOBALS['TL_DCA']['tl_member']['fields'][$field]['eval']['mandatory'];
        });

        return $fields;
    }
}
