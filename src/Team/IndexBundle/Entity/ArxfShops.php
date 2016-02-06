<?php

namespace Team\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArxfShops
 */
class ArxfShops
{
    /**
     * @var string
     */
    private $shopName;

    /**
     * @var float
     */
    private $provisionTb;

    /**
     * @var float
     */
    private $provisionTeams;

    /**
     * @var integer
     */
    private $catRef;

    /**
     * @var string
     */
    private $picRef;

    /**
     * @var string
     */
    private $linkRef;

    /**
     * @var integer
     */
    private $partnerRef;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set shopName
     *
     * @param string $shopName
     * @return ArxfShops
     */
    public function setShopName($shopName)
    {
        $this->shopName = $shopName;

        return $this;
    }

    /**
     * Get shopName
     *
     * @return string 
     */
    public function getShopName()
    {
        return $this->shopName;
    }

    /**
     * Set provisionTb
     *
     * @param float $provisionTb
     * @return ArxfShops
     */
    public function setProvisionTb($provisionTb)
    {
        $this->provisionTb = $provisionTb;

        return $this;
    }

    /**
     * Get provisionTb
     *
     * @return float 
     */
    public function getProvisionTb()
    {
        return $this->provisionTb;
    }

    /**
     * Set provisionTeams
     *
     * @param float $provisionTeams
     * @return ArxfShops
     */
    public function setProvisionTeams($provisionTeams)
    {
        $this->provisionTeams = $provisionTeams;

        return $this;
    }

    /**
     * Get provisionTeams
     *
     * @return float 
     */
    public function getProvisionTeams()
    {
        return $this->provisionTeams;
    }

    /**
     * Set catRef
     *
     * @param integer $catRef
     * @return ArxfShops
     */
    public function setCatRef($catRef)
    {
        $this->catRef = $catRef;

        return $this;
    }

    /**
     * Get catRef
     *
     * @return integer 
     */
    public function getCatRef()
    {
        return $this->catRef;
    }

    /**
     * Set picRef
     *
     * @param string $picRef
     * @return ArxfShops
     */
    public function setPicRef($picRef)
    {
        $this->picRef = $picRef;

        return $this;
    }

    /**
     * Get picRef
     *
     * @return string 
     */
    public function getPicRef()
    {
        return $this->picRef;
    }

    /**
     * Set linkRef
     *
     * @param string $linkRef
     * @return ArxfShops
     */
    public function setLinkRef($linkRef)
    {
        $this->linkRef = $linkRef;

        return $this;
    }

    /**
     * Get linkRef
     *
     * @return string 
     */
    public function getLinkRef()
    {
        return $this->linkRef;
    }

    /**
     * Set partnerRef
     *
     * @param integer $partnerRef
     * @return ArxfShops
     */
    public function setPartnerRef($partnerRef)
    {
        $this->partnerRef = $partnerRef;

        return $this;
    }

    /**
     * Get partnerRef
     *
     * @return integer 
     */
    public function getPartnerRef()
    {
        return $this->partnerRef;
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
