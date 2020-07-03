<?php

namespace In2code\Femanagerextended\Finisher;

use In2code\Femanagerextended\Domain\Model\User;
use In2code\Femanagerextended\Domain\Service\SalesForceApi;
use In2code\Femanager\Finisher\AbstractFinisher;

/**
 * *Salesforce registration checks if the user is already in salesforce if not create a new *user as contact and writes custom note related to the user if this one is already present
 * *This class needs the package bjsmasth\Salesforce from composer to work
 */
class SaleforceRegistration extends AbstractFinisher
{
    /**
     * @var User
     */
    protected $user;

    /**
     * *salesforce user registration as contact
     *
     * @return void
     */
    public function initializeFinisher()
    {
        $salesforceApi = new SalesForceApi($this->user);
        $salesforceApi->authenticate();
        $id_contact = $salesforceApi->checkUserInSalesforce();
        $contact_note_data = $salesforceApi->contactSalesforceData();
        if ($id_contact == null) {
            $id_contact=  $salesforceApi->createContact();
            $id_note = $salesforceApi->createContactNote($contact_note_data);
        } else {
            $id_note = $salesforceApi->createB2BNote($contact_note_data);
        }
        if ($id_note != null) {
            $salesforceApi->linkContactAndNote($id_note, $id_contact);
        }
    }
}
