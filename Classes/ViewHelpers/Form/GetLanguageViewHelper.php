<?php
declare (strict_types=1);

namespace In2code\Femanagerextended\ViewHelpers\Form;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class GetCountriesViewHelper
 */
class GetLanguageViewHelper extends AbstractViewHelper
{
    protected $languages = [
        'French' => 'French',
        'Polish' => 'Polish',
        'CZ' => 'Czech',
        'Swedish' => 'Swedish',
        'German' => 'German',
        'English' => 'English',
    ];
    protected $languages_de = [
        'French' => 'Französisch',
        'Polish' => 'Polnisch',
        'CZ' => 'Tschechisch',
        'Swedish' => 'Schwedisch',
        'German' => 'Deutsch',
        'English' => 'Englisch',
    ];

    /**
     * *Build an language array base on the language
     *
     * @return array
     */
    public function render()
    {
        switch ($this->getLanguage()) {
            case 'de':
                asort($this->languages_de);
                return $this->languages_de;
                break;
            default:
                asort($this->languages);
                return $this->languages;
                break;
        }
    }

    /**
     * *return language name
     * @param $index
     * @return string
     */
    public function GetLanguageValue($index)
    {
        return $this->languages[$index];
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
