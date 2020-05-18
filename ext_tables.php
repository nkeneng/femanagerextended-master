<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

/**
 * Add new fields to fe_users table
 */
$GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
$tmpFeUsersColumns = [
    'language' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:femanagerextended/Resources/Private/Language/locallang_db.xlf:' .
            'tx_femanagerextended_domain_model_user.language',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['French', 'French'],
                ['Polish', 'Polish'],
                ['CZ', 'Czech'],
                ['Swedish', 'Swedish'],
                ['German', 'German'],
                ['English', 'English'],
            ],
        ],
    ],
    'region' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:femanagerextended/Resources/Private/Language/locallang_db.xlf:' .
            'tx_femanagerextended_domain_model_user.region',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['Europe', 'Europe'],
                ['America', 'America'],
                ['Middle East', 'Middle East'],
                ['Other', 'Other'],
            ],
        ],
    ],
    'other_title' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:femanagerextended/Resources/Private/Language/locallang_db.xlf:' .
            'tx_femanagerextended_domain_model_user.other_title',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'workarea' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:femanagerextended/Resources/Private/Language/locallang_db.xlf:' .
            'tx_femanagerextended_domain_model_user.workarea',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['Medical Technology', 'Medical Technology'],
                ['Doctors', 'Doctors'],
                ['Therapists & Nursing Staff', 'Therapists & Nursing Staff'],
                ['Clinical Administration', 'Clinical Administration'],
                ['Investors', 'Investors'],
                ['Other', 'Other'],
            ],
        ],
    ],
    'profession' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:femanagerextended/Resources/Private/Language/locallang_db.xlf:' .
            'tx_femanagerextended_domain_model_user.profession',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'academic_title' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:femanagerextended/Resources/Private/Language/locallang_db.xlf:' .
            'tx_femanagerextended_domain_model_user.academic_title',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['Dipl. Ing.', 'Dipl. Ing.'],
                ['Dipl. Ing. Univ.', 'Dipl. Ing. Univ.'],
                ['Dr.', 'Dr.'],
                ['PD Dr. Med', 'PD Dr. Med'],
                ['PhD', 'PhD'],
                ['Prof.', 'Prof.'],
                ['Prof. Dr.', 'Prof. Dr.'],
                ['MD', 'MD'],
                ['Dipl.-Jur.', 'Dipl.-Jur.'],
                ['Dipl.-Kfm', 'Dipl.-Kfm'],
                ['M.S.', 'M.S.'],
                ['Other title', 'Other title'],
            ],
        ],
    ],
    'tx_extbase_type' => [
        'config' => [
            'type' => 'input',
            'default' => '0'
        ]
    ]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmpFeUsersColumns, true);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'language, region','profession','academic_title','other_title','workarea');

/**
 * Add page TSConfig for the two new fields
 */
$tsConfig = 'tx_femanager.flexForm.new.addFieldOptions.language = Language' . PHP_EOL;
$tsConfig .= 'tx_femanager.flexForm.new.addFieldOptions.region = Region' . PHP_EOL;
$tsConfig .= 'tx_femanager.flexForm.new.addFieldOptions.workarea = Workarea' . PHP_EOL;
$tsConfig .= 'tx_femanager.flexForm.new.addFieldOptions.profession = Profession' . PHP_EOL;
$tsConfig .= 'tx_femanager.flexForm.new.addFieldOptions.academic_title = academic_title' . PHP_EOL;
$tsConfig .= 'tx_femanager.flexForm.new.addFieldOptions.other_title = Other_title' . PHP_EOL;
$tsConfig .= 'tx_femanager.flexForm.edit < tx_femanager.flexForm.new';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($tsConfig);
