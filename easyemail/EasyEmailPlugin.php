<?php
/**
 * Easy Email plugin for Craft CMS
 *
 * Minimal email sender using variables from a POST request.
 *
 * @author    Piccirilli Dorsey, Inc. (Nicholas O'Donnell)
 * @copyright Copyright (c) 2016 Piccirilli Dorsey, Inc. (Nicholas O'Donnell)
 * @link      http://picdorsey.com
 * @package   EasyEmail
 * @since     1.0.1
 */

namespace Craft;

class EasyEmailPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init()
    {
    }

    /**
     * @return mixed
     */
    public function getName()
    {
         return Craft::t('Easy Email');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('Minimal email sender using variables from a POST request.');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'https://github.com/picdorsey/craft-easyemail/blob/master/readme.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/picdorsey/craft-easyemail/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.1';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'Piccirilli Dorsey, Inc.';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'http://picdorsey.com';
    }

    /**
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

    /**
     */
    public function onBeforeInstall()
    {
    }

    /**
     */
    public function onAfterInstall()
    {
    }

    /**
     */
    public function onBeforeUninstall()
    {
    }

    /**
     */
    public function onAfterUninstall()
    {
    }
}
