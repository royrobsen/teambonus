<?php

namespace Team\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArxfPayout
 */
class ArxfPayout
{
    /**
     * @var integer
     */
    private $teamRef;

    /**
     * @var \DateTime
     */
    private $createdDate;

    /**
     * @var float
     */
    private $payValue;

    /**
     * @var integer
     */
    private $state;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set teamRef
     *
     * @param integer $teamRef
     * @return ArxfPayout
     */
    public function setTeamRef($teamRef)
    {
        $this->teamRef = $teamRef;

        return $this;
    }

    /**
     * Get teamRef
     *
     * @return integer 
     */
    public function getTeamRef()
    {
        return $this->teamRef;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return ArxfPayout
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime 
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set payValue
     *
     * @param float $payValue
     * @return ArxfPayout
     */
    public function setPayValue($payValue)
    {
        $this->payValue = $payValue;

        return $this;
    }

    /**
     * Get payValue
     *
     * @return float 
     */
    public function getPayValue()
    {
        return $this->payValue;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return ArxfPayout
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
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
