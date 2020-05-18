<?php

namespace In2code\Femanagerextended\Controller;

use \In2code\Femanagerextended\Domain\Model\User;
use In2code\Femanagerextended\Xclass\Extbase\Mvc\Controller\Argument;

class EditController extends \In2code\Femanager\Controller\EditController {

    /**
     * @return void
     */
    public function initializeUpdateAction()
    {
        if ($this->arguments->hasArgument('user')) {
            // Workaround to avoid php7 warnings of wrong type hint.
            /** @var Argument $user */
            $user = $this->arguments['user'];
            $user->setDataType(User::class);
        }
    }

    /**
     * action update
     *
     * @param \In2code\Femanager\Domain\Model\User $user
     * @return void
     * @validate $user In2code\Femanager\Domain\Validator\ServersideValidator
     * @validate $user In2code\Femanager\Domain\Validator\PasswordValidator
     * @validate $user In2code\Femanager\Domain\Validator\CaptchaValidator
     */
    public function updateAction(\In2code\Femanager\Domain\Model\User $user) {
        parent::updateAction($user);
    }
}
