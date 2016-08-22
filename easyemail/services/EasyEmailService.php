<?php
/**
 * Easy Email plugin for Craft CMS
 *
 * EasyEmail Service
 *
 * @author    Piccirilli Dorsey, Inc. (Nicholas O'Donnell)
 * @copyright Copyright (c) 2016 Piccirilli Dorsey, Inc. (Nicholas O'Donnell)
 * @link      http://picdorsey.com
 * @package   EasyEmail
 * @since     1.0.0
 */

namespace Craft;

class EasyEmailService extends BaseApplicationComponent
{
    /**
     * Sends email form model
     *
     * @param  EmailModel
     * @return  bool successful
     */
    public function sendEmail(EmailModel $email)
    {
        return craft()->email->sendEmail($email);
    }

    /**
     * Renders strings with variables defined as single handlebars using twig
     *
     * @param twig string w/ variables single handle bar syntax
     * @return parsed string
     */
    public function renderSingleHandlebarString($str, $fields)
    {
        // properly wrap vars
        $str = str_replace('{', '{{', $str);
        $str = str_replace('}', '}}', $str);

        return craft()->templates->renderString($str, $fields);
    }

    /**
     * Checks to see if valid template has been passed
     *
     * @param array $fields
     * @return bool valid
     */
    public function isValidTemplate($fields)
    {
        return (! array_key_exists('template', $fields)) || (array_key_exists('template', $fields) && ! craft()->easyEmail->templateExists($fields['template']));
    }

    /**
     * Checks to see if a template exists
     *
     * @param template path
     * @return bool exists
     */
    private function templateExists($path)
    {
        return IOHelper::fileExists($path);
    }

    /**
     * Checks if required fields are submitted
     *
     * @param array $fields
     * @return bool passed
     */
    public function hasRequired($fields)
    {
        if (! array_key_exists('required', $fields)) {
            return true;
        }

        $required = explode('|', $fields['required']);

        foreach ($required as $field) {
            if (! array_key_exists($field, $fields)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Gets list of required fields that are not submitted
     *
     * @param array $fields
     * @return array required fields needed
     */
    private function getRequired($fields)
    {
        $requiredFields = [];

        if (! array_key_exists('required', $fields)) {
            return true;
        }

        $required = explode('|', $fields['required']);

        foreach ($required as $field) {
            if (! array_key_exists($field, $fields)) {
                $requiredFields[] = $field;
            }
        }

        return $requiredFields;
    }

    /**
     * Gets human readable string of required fields still needed
     *
     * @param array $fields
     * @return string
     */
    public function getHumanReadableRequiredError($fields)
    {
        $required = implode('\', \'', craft()->easyEmail->getRequired($fields));
        $required = '\'' . $required . '\'';


        return strtoupper(preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]/', ' $0', $required)) . ' is required.';
    }

    /**
     * Manipulates email model to support format we need.
     *
     * Renders template
     * Populates plain text fallback
     * Renders subject string
     *
     * @param  EmailModel
     * @param  array fields to pass to twig
     * @return  void
     */
    public function renderSubjectAndBody(EmailModel $email, $fields)
    {
        $email->htmlBody = craft()->templates->render($fields['template'], $fields);
        $email->body = strip_tags($email->htmlBody);
        $email->subject = $email->subject ? craft()->easyEmail->renderSingleHandlebarString($email->subject, $fields) : null;
    }
}
