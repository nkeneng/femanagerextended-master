<?php

namespace Aleksundshantu\Femanagerextended\Controller;
use Aleksundshantu\Femanagerextended\Domain\Model\User;
use Aleksundshantu\Femanagerextended\Domain\Service\DownloadService;
use Aleksundshantu\Femanagerextended\Xclass\Extbase\Mvc\Controller\Argument;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;
use TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException;

/**
 * Class NewController
 * @package Aleksundshantu\Femanagerextended\Controller
 */
class NewController extends \In2code\Femanager\Controller\NewController {

    /**
     * Initialize create action for setting the right custom data type for the user.
     */
    public function initializeCreateAction() {
        if ($this->arguments->hasArgument('user')) {
            // Workaround to avoid php7 warnings of wrong type hint.
            /** @var Argument $user */
            $user = $this->arguments['user'];
            $user->setDataType(User::class);
        }
    }

    /**
     * action create
     *
     * @param \In2code\Femanager\Domain\Model\User $user
     * @return void
     * @validate $user In2code\Femanager\Domain\Validator\ServersideValidator
     * @validate $user In2code\Femanager\Domain\Validator\PasswordValidator
     */
    public function createAction(\In2code\Femanager\Domain\Model\User $user)
    {
        parent::createAction($user);
    }

    /**
     * @throws StopActionException
     * @throws UnsupportedRequestTypeException
     */
    public function createStatusAction()
    {
        $request = $this->request->getArguments();
        $user = $this->userRepository->findByUid($request['user']);
        $request['user'] = $user;
        $this->redirectToUri(DownloadService::SendToSaleforce($request));
    }
}