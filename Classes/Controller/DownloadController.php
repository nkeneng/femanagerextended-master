<?php

namespace In2code\Femanagerextended\Controller;


use In2code\Femanagerextended\Domain\Model\User;
use In2code\Femanagerextended\Utility\Dumper;

class DownloadController {


    public function sendToSalesforceAction(User $user, string $fileName,string $filePath) {
        Dumper::dumper('in controller');
    }
}