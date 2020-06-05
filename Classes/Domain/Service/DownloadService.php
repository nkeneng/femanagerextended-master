<?php

namespace In2code\Femanagerextended\Domain\Service;


use In2code\Femanager\Domain\Repository\UserRepository;
use In2code\Femanagerextended\Domain\Model\User;
use TYPO3\CMS\Extbase\Object\ObjectManager;


class DownloadService
{
    /**
     * @param array $request
     * @return string
     */
    public static function SendToSaleforce(array $request)
    {
        $fileName = $request['fileName'];
        $filePath = $request['filePath'];
        $user = $request['user'];

        if ($user instanceof User && $fileName != '' && $filePath != '') {
            $salesforceApi = new SalesForceApi($user);
            $salesforceApi->authenticate();
            $id_contact = $salesforceApi->checkUserInSalesforce();
            if ($id_contact != null) {
                $note_data = [
                    'Title' => "B2B Download : $fileName",
                    'Content' => base64_encode("Der Kontakt hat sich $fileName heruntergeladen."),
                    'OwnerId' => '0051i000001E1oQAAS'];
                $id_note = $salesforceApi->getCrud()->create('ContentNote', $note_data);
                $salesforceApi->linkContactAndNote($id_note, $id_contact);
                $uri = "/$filePath";
            } else $uri = "/";
        } else $uri = "/";
        return ($uri);
    }
}