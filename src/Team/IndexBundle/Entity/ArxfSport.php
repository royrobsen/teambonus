<?php

namespace Team\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArxfSport
 */
class ArxfSport
{
    /**
     * @var string
     */
    private $sportName;

    /**
     * @var string
     */
    private $sportUrl;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set sportName
     *
     * @param string $sportName
     * @return ArxfSport
     */
    public function setSportName($sportName)
    {
        $this->sportName = $sportName;

        return $this;
    }

    /**
     * Get sportName
     *
     * @return string 
     */
    public function getSportName()
    {
        return $this->sportName;
    }

    /**
     * Set sportUrl
     *
     * @param string $sportUrl
     * @return ArxfSport
     */
    public function setSportUrl($sportUrl)
    {
        $this->sportUrl = $sportUrl;

        return $this;
    }

    /**
     * Get sportUrl
     *
     * @return string 
     */
    public function getSportUrl()
    {
        return $this->sportUrl;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
