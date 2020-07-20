<?php
declare (strict_types = 1);
namespace Aleksundshantu\Femanagerextended\ViewHelpers\Form;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class GetacademictitleViewHelper
 */
class GetacademictitleViewHelper extends AbstractViewHelper
{
    /**
     * @var array
     */
    protected $title = [
        'Dipl. Ing.' => 'Dipl. Ing.',
        'Dipl. Ing. Univ.' => 'Dipl. Ing. Univ.',
        'Dr.' => 'Dr.',
        'PD Dr. Med' => 'PD Dr. Med',
        'PhD' => 'PhD',
        'Prof.' => 'Prof.',
        'Prof. Dr.' => 'Prof. Dr.',
        'MD' => 'MD',
        'Dipl.-Jur.' => 'Dipl.-Jur.',
        'Dipl.-Kfm' => 'Dipl.-Kfm',
        'M.S.' => 'M.S.',
        'Other title' => 'Other title',
    ];

    /**
     * Build an country array
     *
     * @return array
     */
    public function render(): array
    {
        return $this->title;
    }
}
