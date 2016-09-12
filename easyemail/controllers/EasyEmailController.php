<?php
/**
 * Easy Email plugin for Craft CMS
 *
 * EasyEmail Controller
 *
 * @author    Piccirilli Dorsey, Inc. (Nicholas O'Donnell)
 * @copyright Copyright (c) 2016 Piccirilli Dorsey, Inc. (Nicholas O'Donnell)
 * @link      http://picdorsey.com
 * @package   EasyEmail
 * @since     1.0.1
 */

namespace Craft;

class EasyEmailController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = true;

    /**
     * Sends the email
     */
    public function actionSend()
    {
        // get post data
        $this->requirePostRequest();
        $fields = craft()->request->getPost();

        // check required
        if (! craft()->easyEmail->hasRequired($fields)) {
            craft()->userSession->setFlash('notice', craft()->easyEmail->getHumanReadableRequiredError($fields));
            return;
        }

        // template check
        if (! craft()->easyEmail->isValidTemplate($fields)) {
            craft()->userSession->setFlash('notice', Craft::t('Please provide a valid template.'));
        }

        // populate our model!
        $email = EmailModel::populateModel($fields);

        // model field manipulation
        craft()->easyEmail->renderSubjectAndBody($email, $fields);

        // email validation
        if (! $email->validate()) {
            craft()->userSession->setFlash('notice', Craft::t('Please correct the errors below.'));
            craft()->urlManager->setRouteVariables([
                'email' => $email
            ]);
            return;
        }

        // send email
        if (! craft()->easyEmail->sendEmail($email)) {
            craft()->userSession->setFlash('notice', Craft::t('Unable to send email.'));
            craft()->urlManager->setRouteVariables([
                'email' => $email
            ]);
            return;
        }

        // redirect
        $this->redirectToPostedUrl();
    }
}
