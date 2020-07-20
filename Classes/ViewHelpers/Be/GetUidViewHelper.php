<?php
declare (strict_types = 1);

namespace Aleksundshantu\Femanagerextended\ViewHelpers\Be;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class GetClassNameOnActionViewHelper
 */
class GetUidViewHelper extends AbstractViewHelper
{
    /**
     * Return className if actionName fits to current action
     *
     * @return string
     */
    public function render(): string
    {
        return strval($GLOBALS['TSFE']->fe_user->user['uid']);
    }

}
