<?php
declare (strict_types = 1);
namespace In2code\Femanagerextended\ViewHelpers\Form;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use In2code\Femanagerextended\ViewHelpers\Form\GetCountriesViewHelper;

/**
 * Class GetCountryNameViewHelper
 */
class GetCountryNameViewHelper extends AbstractViewHelper
{
    /**
     * @var GetCountriesViewHelper
     */
    private $helper;

    /**
     * @return void
     */
    public function initializeArguments() {
        $this->registerArgument('index', 'string', 'index of the country to fetch');
    }

    /**
     ** return the country name of the index passed 
     * @param string $index
     */
    public function render(): string
    {
        $index = $this->arguments['index'];
        $this->helper = new GetCountriesViewHelper();
        $country = $this->helper->GetCountryValue($index);
        return $country;
    }
}
