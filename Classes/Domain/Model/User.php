<?php

namespace In2code\Femanagerextended\Domain\Model;

use In2code\Femanager\Domain\Model\User as UserFemanager;

class User extends UserFemanager
{

    /**
     * language
     *
     * @var string
     */
    protected $language;

    /**
     * other_title
     *
     * @var string
     */
    protected $other_title;

    /**
     * region
     *
     * @var string
     */
    protected $region;

    /**
     * profession
     *
     * @var string
     */
    protected $profession;
    /**
     * academic
     *
     * @var string
     */
    protected $academic_title;
    /**
     * workarea
     *
     * @var string
     */
    protected $workarea;


    /**
     * @return string
     */
    public function getProfession(): string
    {
        return $this->profession;
    }

    /**
     * @param string $profession
     */
    public function setProfession(string $profession): void
    {
        $this->profession = $profession;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getAcademicTitle(): string
    {
        return $this->academic_title;
    }

    /**
     * @param string $academic_title
     */
    public function setAcademicTitle(string $academic_title): void
    {
        $this->academic_title = $academic_title;
    }

    /**
     * @return string
     */
    public function getOtherTitle(): string
    {
        return $this->other_title;
    }

    /**
     * @param string $other_title
     */
    public function setOtherTitle(string $other_title): void
    {
        $this->other_title = $other_title;
    }

    /**
     * @return string
     */
    public function getWorkarea(): string
    {
        return $this->workarea;
    }

    /**
     * @param string $workarea
     */
    public function setWorkarea(string $workarea): void
    {
        $this->workarea = $workarea;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }
}
