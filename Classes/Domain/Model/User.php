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
     * othertitle
     *
     * @var string
     */
    protected $othertitle;

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
     * academictitle
     *
     * @var string
     */
    protected $academictitle;
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
    public function getAcademictitle(): string
    {
        return $this->academictitle;
    }

    /**
     * @param string $academictitle
     */
    public function setAcademictitle(string $academictitle): void
    {
        $this->academictitle = $academictitle;
    }

    /**
     * @return string
     */
    public function getOthertitle(): string
    {
        return $this->othertitle;
    }

    /**
     * @param string $othertitle
     */
    public function setOthertitle(string $othertitle): void
    {
        $this->othertitle = $othertitle;
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
