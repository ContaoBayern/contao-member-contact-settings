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

class TemplateModifier
{
    /**
     * Modifies a frontend template and returns it as string.
     *
     * @param string $buffer       Content of the parsed front end template
     * @param string $templateName The template name (e.g. nav_default) without file extension
     *
     * @return string the template with the modification
     */
    public function modifyFrontendTemplate($buffer, $templateName)
    {
        // Add attribute "novalidate" to member data form
        if ($templateName === 'member_default') {
            $dom = new \DOMDocument();
            // Add encoding and create dom document without html wrapper
            $dom->loadHTML('<?xml encoding="utf-8" ?>'.$buffer, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            foreach ($dom->getElementsByTagName('form') as $tag) {
                $tag->setAttribute('novalidate', 'novalidate');
            }
            // Save html without encoding string
            $buffer = $dom->saveHTML($dom->documentElement);
        }

        return $buffer;
    }
}
