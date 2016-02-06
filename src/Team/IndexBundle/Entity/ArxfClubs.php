<?php

namespace Team\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArxfClubs
 */
class ArxfClubs
{
    /**
     * @var string
     */
    private $clubName;

    /**
     * @var string
     */
    private $clubPic;
    /**
     * @var integer
     */
    private $active;
    
    /**
     * @var integer
     */
    private $id;


    /**
     * Set clubName
     *
     * @param string $clubName
     * @return ArxfClubs
     */
    public function setClubName($clubName)
    {
        $this->clubName = $clubName;

        return $this;
    }

    /**
     * Get clubName
     *
     * @return string 
     */
    public function getClubName()
    {
        return $this->clubName;
    }

    /**
     * Set clubPic
     *
     * @param string $clubPic
     * @return ArxfClubs
     */
    public function setClubPic($clubPic)
    {
        $this->clubPic = $clubPic;

        return $this;
    }

    /**
     * Get clubPic
     *
     * @return string 
     */
    public function getClubPic()
    {
        return $this->clubPic;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return Active
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string 
     */
    public function getActive()
    {
        return $this->active;
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $team;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add team
     *
     * @param \Team\IndexBundle\Entity\ArxfTeams $team
     * @return ArxfClubs
     */
    public function addTeam(\Team\IndexBundle\Entity\ArxfTeams $team)
    {
        $this->team[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \Team\IndexBundle\Entity\ArxfTeams $team
     */
    public function removeTeam(\Team\IndexBundle\Entity\ArxfTeams $team)
    {
        $this->team->removeElement($team);
    }

    /**
     * Count team
     *
     * @param \Team\IndexBundle\Entity\ArxfTeams $team
     */
    public function countTeam(\Team\IndexBundle\Entity\ArxfTeams $team)
    {
        $this->team->count($team);
    }
    
    /**
     * Get team
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeam()
    {
        return $this->team;
    }
    
    private $attachment;
    
    /**
     * Set attachment
     */
    public function setAttachment($attachment = null)
    {
        $this->attachment = $attachment;

        return $this;
    }

    /**
     * Get attachment
     */
    public function getAttachment()
    {
        return $this->attachment;
    }
    
    private $allField;
    
    /**
     * Set allFields
     *
     * @param string allField
     * @return ArxfClubs
     */
    public function setAllField($allField)
    {
        $this->allField = $allField;
        return $this;
    }
    /**
     * Get allField
     *
     * @return string 
     */
    public function getAllField()
    {
        return $this->allField;
    }
}
