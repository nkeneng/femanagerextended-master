<?php
declare(strict_types=1);
namespace Aleksundshantu\Femanagerextended\ViewHelpers\Form;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class GetCountriesViewHelper
 */
class GetRegionViewHelper extends AbstractViewHelper
{

    /**
     * @var array
     */
    protected $countries = [
        'Europe' => 'Europe',
        'america' => 'America',
        'Middle East' => 'Middle East',
        'Other' => 'Other'
    ];

    /**
     * Build an country array
     *
     * @return array
     */
    public function render(): array
    {
        return $this->countries;
    }
}
