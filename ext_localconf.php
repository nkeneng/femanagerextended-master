<?php

use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3_MODE') || die('Access denied.');

$signalSlotDispatcher = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher');

/**
 * replace the username by the email
 */
$signalSlotDispatcher->connect(
    'In2code\Femanager\Controller\NewController',
    'createActionBeforePersist',
    'Aleksundshantu\Femanagerextended\Domain\Service\SaveFurtherInformationService',
    'replaceUsername',
    FALSE
);

/**
 * signal slot to validate the data given in dropdown by the user
 */
$signalSlotDispatcher->connect(
    'In2code\Femanager\Controller\NewController',
    'createActionBeforePersist',
    'Aleksundshantu\Femanagerextended\Domain\Service\SaveFurtherInformationService',
    'validData',
    FALSE
);

/**
 * signal to save set the user group base on region and workarea
 */
$signalSlotDispatcher->connect(
    'In2code\Femanager\Controller\NewController',
    'createActionBeforePersist',
    'Aleksundshantu\Femanagerextended\Domain\Service\SaveFurtherInformationService',
    'saveUserGroup',
    FALSE
);


$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Extbase\\Mvc\\Controller\\Argument'] = array('className' => 'Aleksundshantu\\Femanagerextended\\Xclass\\Extbase\\Mvc\\Controller\\Argument');