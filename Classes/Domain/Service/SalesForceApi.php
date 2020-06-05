<?php

namespace In2code\Femanagerextended\Domain\Service;

use bjsmasth\Salesforce\Authentication\PasswordAuthentication;
use bjsmasth\Salesforce\CRUD;
use bjsmasth\Salesforce\Exception\SalesforceAuthentication;
use In2code\Femanagerextended\Domain\Model\User;
use In2code\Femanagerextended\ViewHelpers\Form\GetCountriesViewHelper;

/**
 * Class SalesForceApi
 * @package In2code\Femanager\Domain\Service
 */
class SalesForceApi
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var CRUD
     */
    private $crud;
    /**
     * @var GetCountriesViewHelper
     */
    private $country;

    private $apiData;

    public function __construct(User $user)
    {
        if (isset($GLOBALS['TYPO3_CONF_VARS']['API']) && $GLOBALS['TYPO3_CONF_VARS']['API'] != null){
            $this->apiData = $GLOBALS['TYPO3_CONF_VARS']['API'];
        }else $this->apiData = [];
        $this->country = new GetCountriesViewHelper();
        $this->user = $user;
    }

    /**
     * authenticate to the salesforce endpoint
     */
    public function authenticate()
    {
        if (count($this->apiData) > 0) {
            $options = [
                'grant_type' => $this->apiData['grant_type'],
                'client_id' => $this->apiData['client_id'],
                'client_secret' => $this->apiData['client_secret'],
                'username' => $this->apiData['username'],
                'password' => $this->apiData['password'],
            ];
        } else $options = [];

        $salesforce = new PasswordAuthentication($options);
        try {
            $salesforce->authenticate();
            $this->crud = new CRUD();
        } catch (SalesforceAuthentication $e) {
            return;
        }
    }

    /**
     * @return mixed
     */
    public function checkUserInSalesforce()
    {
        $query = 'SELECT Id FROM Contact WHERE Email = \'' . $this->user->getEmail() . '\' AND LastName = \'' . $this->user->getLastname() . '\' AND FirstName = \'' . $this->user->getFirstname() . '\'';
        $response = $this->crud->query($query);
        return $response['records'][0]['Id'];
    }

    /**
     * @return string
     */
    public function getUserGroup()
    {
        return $this->user->getWorkarea() . ' - ' . $this->user->getRegion();
    }

    /**
     * @return string
     */
    public function contactSalesforceData()
    {
        return
            '<p><b>Erfolgreiche Registrierung für B2B Web-Login</b></p> <br>
            <p> <b>Name</b>: ' . $this->user->getFirstName() . ' ' . $this->user->getFirstName() . '</p> <br>
            <p><b>Work area:</b> ' . $this->user->getWorkarea() . '</p> <br>
            <p><b>Profession</b>: ' . $this->user->getProfession() . '</p> <br>
            <p><b>Usergruppe</b>: ' . $this->getUserGroup() . '</p> <br>
            <p><b>Company</b>: ' . $this->user->getCompany() . '</p> <br>
            <p><b>Country</b>: ' . $this->country->GetCountryValue($this->user->getCountry()) . '</p> <br>
            ';
    }

    /**
     * @return array
     */
    public function createContact()
    {
        $contact_data = [
            'LastName' => $this->user->getLastname(),
            'FirstName' => $this->user->getFirstname(),
            'Email' => $this->user->getEmail(),
            'Specialty_Additional__c' => $this->user->getProfession(),
            'Language__c' => $this->user->getLanguage(),
            'DSGVO_Acceptance__c' => 'Yes',
        ];
        if ($this->user->getOthertitle() == null) {
            $contact_data['Academic_Title__c'] = $this->user->getAcademictitle();
        } else {
            $contact_data['Suffix'] = $this->user->getAcademictitle();
        }
        $this->setUserWorkArea($this->user->getWorkarea(), $contact_data);
        return $this->crud->create('Contact', $contact_data);
    }

    private function setUserWorkArea($workArea, &$contact_data)
    {

        switch ($workArea) {
            case 'Medical Technology':
                $contact_data['Department_of_Clinic__c'] = 'Administrative';
                $contact_data['Specialty__c'] = 'Medizintechnik';
                break;
            case 'Doctors':
                $contact_data['Department_of_Clinic__c'] = 'Medical';
                break;
            case 'Therapists & Nursing Staff':
                $contact_data['Department_of_Clinic__c'] = 'Care';
                break;
            case 'Clinical Administration':
                $contact_data['Department_of_Clinic__c'] = 'Administrative';
                break;
            case 'Other':
            case 'Investors':
                $contact_data['Department_of_Clinic__c'] = 'Other';
                break;
        }
    }

    /**
     * @param $content
     * @return mixed
     */
    public function createContactNote($content)
    {
        $note_data = [
            'Title' => "B2B account confirmed, Contact added. ",
            'Content' => base64_encode($content . '<p>Dieser Kontakt wurde automatisch erstellt aufgrund einer Registrierung für das B2B-Portal.</p>'),
            'OwnerId' => '0051i000001E1oQAAS'];
        return $this->crud->create('ContentNote', $note_data);
    }

    /**
     * @param $contact_note_data
     * @return mixed
     */
    public function createB2BNote($contact_note_data)
    {
        $b2b_note = [
            'Title' => "B2B account confirmed.",
            'Content' => base64_encode($contact_note_data . '<p> Dieser Notiz wurde erstellt weil der Kontakt schon in Salesforce vorhanden ist</p>'),
            'OwnerId' => '0051i000001E1oQAAS'];
        return $this->crud->create('ContentNote', $b2b_note);
    }

    /**
     * @param $id_note
     * @param $id_contact
     */
    public function linkContactAndNote($id_note, $id_contact)
    {
        $documentLink_data = [
            "ContentDocumentId" => $id_note,
            "LinkedEntityId" => $id_contact,
            "ShareType" => "v",
        ];
        $this->crud->create('ContentDocumentLink', $documentLink_data);
    }

    /**
     * @return CRUD
     */
    public function getCrud(): CRUD
    {
        return $this->crud;
    }
}