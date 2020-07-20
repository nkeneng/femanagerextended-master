<?php
declare (strict_types=1);

namespace Aleksundshantu\Femanagerextended\ViewHelpers\Form;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class GetCountriesViewHelper
 */
class GetCountriesViewHelper extends AbstractViewHelper
{

    protected $countries = [
        'DEU' => 'Germany',
        'AUT' => 'Austria',
        'CHE' => 'Switzerland',
        'ITA' => 'Italy',
        'NLD' => 'Netherlands',
        'GBR' => 'United Kingdom',
        'FRA' => 'France',
        'ESP' => 'Spain',
        'Other Europe' => 'Europe Other',
        'CHN' => 'China',
        'TWN' => 'Taiwan',
        'Other Asia' => 'Asia Other',
        'AUS' => 'Australia',
        'USA' => 'USA',
        'CAN' => 'Canada',
        'Africa' => 'Africa',
        'Mittlerer Osten' => 'Middle East',
        'Central America' => 'Central America',
    ];
    protected $countries_de = [
        'DEU' => 'Deutschland',
        'AUT' => 'Österreich',
        'CHE' => 'Schweiz',
        'ITA' => 'Italien',
        'NLD' => 'Niederlande',
        'GBR' => 'Großbritannien',
        'FRA' => 'Frankreich',
        'ESP' => 'Spanien',
        'Other Europe' => 'Europe Other',
        'CHN' => 'China',
        'TWN' => 'Taiwan',
        'Other Asia' => 'Asia Other',
        'AUS' => 'Australien',
        'USA' => 'USA',
        'CAN' => 'Kanada',
        'Africa' => 'Afrika',
        'Central America' => 'Zentralamerika',
        'Mittlerer Osten' => 'Mittlerer Osten'
    ];

    /**
     * *Build an country array base on the language
     *
     * @return array
     */
    public function render()
    {
        switch ($this->getLanguage()) {
            case 'de':
                asort($this->countries_de);
                return $this->countries_de;
                break;
            default:
                asort($this->countries);
                return $this->countries;
                break;
        }
    }

    /**
     * *return country name
     * @param $index
     * @return string
     */
    public function GetCountryValue($index)
    {
        return $this->countries[$index];
    }

    private function getLanguage()
    {
        if (TYPO3_MODE === 'FE') {
            if (isset($GLOBALS['TSFE']->config['config']['language'])) {
                return ($GLOBALS['TSFE']->config['config']['language']);
            }
        }
    }
}
