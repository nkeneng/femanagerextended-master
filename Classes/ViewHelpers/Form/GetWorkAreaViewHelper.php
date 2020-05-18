<?php
declare(strict_types=1);
namespace In2code\Femanagerextended\ViewHelpers\Form;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class GetCountriesViewHelper
 */
class GetWorkAreaViewHelper extends AbstractViewHelper
{

    /**
     * @var array
     */
    protected $workarea = [
        'medical technology' => 'Medical Technology',
        'doctors' => 'Doctors',
        'therapists and nursing staff' => 'Therapists & Nursing Staff',
        'clinical administration' => 'Clinical Administration',
        'investors' => 'Investors',
        'other' => 'Other'
    ];

    /**
     * Build an country array
     *
     * @return array
     */
    public function render(): array
    {
        return $this->workarea;
    }
}
