<?php

namespace Aleksundshantu\Femanagerextended\Domain\Service;

use Aleksundshantu\Femanagerextended\Domain\Model\User;
use Aleksundshantu\Femanagerextended\Utility\Dumper;
use Aleksundshantu\Femanagerextended\ViewHelpers\Form\GetacademictitleViewHelper;
use Aleksundshantu\Femanagerextended\ViewHelpers\Form\GetCountriesViewHelper;
use Aleksundshantu\Femanagerextended\ViewHelpers\Form\GetLanguageViewHelper;
use Aleksundshantu\Femanagerextended\ViewHelpers\Form\GetRegionViewHelper;
use Aleksundshantu\Femanagerextended\ViewHelpers\Form\GetWorkAreaViewHelper;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class SaveFurtherInformationService
{

    /**
     * @var GetCountriesViewHelper
     */
    private $country;
    /**
     * @var GetLanguageViewHelper
     */
    private $language;
    /**
     * @var GetWorkAreaViewHelper
     */
    private $workarea;
    /**
     * @var GetRegionViewHelper
     */
    private $region;
    /**
     * @var GetacademictitleViewHelper
     */
    private $academic;

    public function __construct()
    {
        $this->country = new GetCountriesViewHelper();
        $this->language = new GetLanguageViewHelper();
        $this->workarea = new GetWorkAreaViewHelper();
        $this->region = new GetRegionViewHelper();
        $this->academic = new GetacademictitleViewHelper();
    }

    public function replaceUsername(User $user, $obj)
    {
        $user->setUsername($user->getEmail());
    }

    /**
     * verify if given data match with ones define in backend
     * @param User $user
     * @param $obj
     */
    public function validData(User $user, $obj)
    {
        if (!array_key_exists($user->getCountry(), $this->country->render())) {
            $user->setCountry('');
        }
        if (!array_key_exists($user->getLanguage(), $this->language->render())) {
            $user->setLanguage('');
        }
        if (!array_key_exists($user->getWorkarea(), $this->workarea->render())) {
            $user->setWorkarea('');
        }
        if (!array_key_exists($user->getRegion(), $this->region->render())) {
            $user->setRegion('');
        }
        if (!array_key_exists($user->getacademictitle(), $this->academic->render())) {
            $user->setacademictitle('');
        }
        if ($user->getAcademictitle() == 'Other title') {
            $user->setAcademictitle($user->getOthertitle());
        }
    }

    /**
     * save userGroup base on the region and the workarea
     * @param User $user
     * @param $obj
     */
    public function saveUserGroup(User $user, $obj)
    {
        $region = $user->getRegion();
        $workarea = $user->getWorkarea();
        $userGroup = $workarea . ' - ' . $region;
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_groups');
        $statement = $queryBuilder
            ->select('uid')
            ->from('fe_groups')
            ->where(
                $queryBuilder->expr()->eq('title', $queryBuilder->createNamedParameter($userGroup))
            )
            ->execute()
            ->fetch();
        $objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $repository = $objectManager->get('In2code\\Femanager\\Domain\\Repository\\UserGroupRepository');
        $newUserGroup = new ObjectStorage();
        $newUserGroup->attach($repository->findByUid($statement['uid']));
        $user->setUsergroup($newUserGroup);
    }
}