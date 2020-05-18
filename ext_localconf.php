<?php
defined('TYPO3_MODE') || die('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'In2code.Femanagerextended',
    'FemanagerExtended',
    [
        \In2code\Femanagerextended\Controller\NewController::class => 'create',
        \In2code\Femanagerextended\Controller\EditController::class => 'update',
    ],
    // non-cacheable actions
    [
//        \In2code\Femanagerextended\Controller\NewController::class => '',
//        \In2code\Femanagerextended\Controller\EditController::class => '',
    ]

);

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Extbase\\Mvc\\Controller\\Argument'] = array('className' => 'In2code\\Femanagerextended\\Xclass\\Extbase\\Mvc\\Controller\\Argument');