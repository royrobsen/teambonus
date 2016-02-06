<?php

namespace Team\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArxfPartner
 */
class ArxfPartner
{
    /**
     * @var string
     */
    private $partnerName;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set partnerName
     *
     * @param string $partnerName
     * @return ArxfPartner
     */
    public function setPartnerName($partnerName)
    {
        $this->partnerName = $partnerName;

        return $this;
    }

    /**
     * Get partnerName
     *
     * @return string 
     */
    public function getPartnerName()
    {
        return $this->partnerName;
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
