<?php

namespace Team\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;

/**
 * ArxfTeams
 */
class ArxfTeams implements UserInterface, \Serializable
{
    /**
     * @var string
     */
    private $teamName;

    /**
     * @var integer
     */
    private $clubRef;

    /**
     * @var string
     */
    private $apFirst;

    /**
     * @var string
     */
    private $apLast;

    /**
     * @var string
     */
    private $apMail;

    /**
     * @var integer
     */
    private $sportRef;

    /**
     * @var string
     */
    private $aboutTeam;

    /**
     * @var string
     */
    private $teamPic;

    /**
     * @var string
     */
    private $teamRefid;

    /**
     * @var string
     */
    private $iban;

    /**
     * @var string
     */
    private $blz;

    /**
     * @var string
     */
    private $accNo;

    /**
     * @var string
     */
    private $bankName;

    /**
     * @var string
     */
    private $accOwner;

    /**
     * @var string
     */
    private $passpalabra;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $apPhone;

    /**
     * @var string
     */
    private $bic;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set teamName
     *
     * @param string $teamName
     * @return ArxfTeams
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;

        return $this;
    }

    /**
     * Get teamName
     *
     * @return string 
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * Set clubRef
     *
     * @param integer $clubRef
     * @return ArxfTeams
     */
    public function setClubRef($clubRef)
    {
        $this->clubRef = $clubRef;

        return $this;
    }

    /**
     * Get clubRef
     *
     * @return integer 
     */
    public function getClubRef()
    {
        return $this->clubRef;
    }

    /**
     * Set apFirst
     *
     * @param string $apFirst
     * @return ArxfTeams
     */
    public function setApFirst($apFirst)
    {
        $this->apFirst = $apFirst;

        return $this;
    }

    /**
     * Get apFirst
     *
     * @return string 
     */
    public function getApFirst()
    {
        return $this->apFirst;
    }

    /**
     * Set apLast
     *
     * @param string $apLast
     * @return ArxfTeams
     */
    public function setApLast($apLast)
    {
        $this->apLast = $apLast;

        return $this;
    }

    /**
     * Get apLast
     *
     * @return string 
     */
    public function getApLast()
    {
        return $this->apLast;
    }

    /**
     * Set apMail
     *
     * @param string $apMail
     * @return ArxfTeams
     */
    public function setApMail($apMail)
    {
        $this->apMail = $apMail;

        return $this;
    }

    /**
     * Get apMail
     *
     * @return string 
     */
    public function getApMail()
    {
        return $this->apMail;
    }

    /**
     * Set sportRef
     *
     * @param integer $sportRef
     * @return ArxfTeams
     */
    public function setSportRef($sportRef)
    {
        $this->sportRef = $sportRef;

        return $this;
    }

    /**
     * Get sportRef
     *
     * @return integer 
     */
    public function getSportRef()
    {
        return $this->sportRef;
    }

    /**
     * Set aboutTeam
     *
     * @param string $aboutTeam
     * @return ArxfTeams
     */
    public function setAboutTeam($aboutTeam)
    {
        $this->aboutTeam = $aboutTeam;

        return $this;
    }

    /**
     * Get aboutTeam
     *
     * @return string 
     */
    public function getAboutTeam()
    {
        return $this->aboutTeam;
    }

    /**
     * Set teamPic
     *
     * @param string $teamPic
     * @return ArxfTeams
     */
    public function setTeamPic($teamPic)
    {
        $this->teamPic = $teamPic;

        return $this;
    }

    /**
     * Get teamPic
     *
     * @return string 
     */
    public function getTeamPic()
    {
        return $this->teamPic;
    }

    /**
     * Set teamRefid
     *
     * @param string $teamRefid
     * @return ArxfTeams
     */
    public function setTeamRefid($teamRefid)
    {
        $this->teamRefid = $teamRefid;

        return $this;
    }

    /**
     * Get teamRefid
     *
     * @return string 
     */
    public function getTeamRefid()
    {
        return $this->teamRefid;
    }

    /**
     * Set iban
     *
     * @param string $iban
     * @return ArxfTeams
     */
    public function setIban($iban)
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * Get iban
     *
     * @return string 
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set blz
     *
     * @param string $blz
     * @return ArxfTeams
     */
    public function setBlz($blz)
    {
        $this->blz = $blz;

        return $this;
    }

    /**
     * Get blz
     *
     * @return string 
     */
    public function getBlz()
    {
        return $this->blz;
    }

    /**
     * Set accNo
     *
     * @param string $accNo
     * @return ArxfTeams
     */
    public function setAccNo($accNo)
    {
        $this->accNo = $accNo;

        return $this;
    }

    /**
     * Get accNo
     *
     * @return string 
     */
    public function getAccNo()
    {
        return $this->accNo;
    }

    /**
     * Set bankName
     *
     * @param string $bankName
     * @return ArxfTeams
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;

        return $this;
    }

    /**
     * Get bankName
     *
     * @return string 
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * Set accOwner
     *
     * @param string $accOwner
     * @return ArxfTeams
     */
    public function setAccOwner($accOwner)
    {
        $this->accOwner = $accOwner;

        return $this;
    }

    /**
     * Get accOwner
     *
     * @return string 
     */
    public function getAccOwner()
    {
        return $this->accOwner;
    }

    /**
     * Set passpalabra
     *
     * @param string $passpalabra
     * @return ArxfTeams
     */
    public function setPasspalabra($passpalabra)
    {
        $this->passpalabra = $passpalabra;

        return $this;
    }

    /**
     * Get passpalabra
     *
     * @return string 
     */
    public function getPasspalabra()
    {
        return $this->passpalabra;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return ArxfTeams
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set apPhone
     *
     * @param string $apPhone
     * @return ArxfTeams
     */
    public function setApPhone($apPhone)
    {
        $this->apPhone = $apPhone;

        return $this;
    }

    /**
     * Get apPhone
     *
     * @return string 
     */
    public function getApPhone()
    {
        return $this->apPhone;
    }

    /**
     * Set bic
     *
     * @param string $bic
     * @return ArxfTeams
     */
    public function setBic($bic)
    {
        $this->bic = $bic;

        return $this;
    }

    /**
     * Get bic
     *
     * @return string 
     */
    public function getBic()
    {
        return $this->bic;
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
     * @var \Team\IndexBundle\Entity\ArxfClubs
     */
    private $club;


    /**
     * Set club
     *
     * @param \Team\IndexBundle\Entity\ArxfClubs $club
     * @return ArxfTeams
     */
    public function setClub(\Team\IndexBundle\Entity\ArxfClubs $club = null)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return \Team\IndexBundle\Entity\ArxfClubs 
     */
    public function getClub()
    {
        return $this->club;
    }
    
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->passpalabra;
    }
    
    public function getRoles()
    {
        if($this->groupId == 1) {
            return array('ROLE_SUPER_ADMIN');
        } 
        elseif($this->groupId == 2) {
            return array('ROLE_ADMIN');
        }
        elseif($this->groupId == 3) {
            return array('ROLE_USER');
        }
        elseif($this->groupId == 0) {
            return array('ROLE_USER');
        }
        elseif($this->groupId == 4) {
            return array('ROLE_GUEST');
        }
        elseif($this->groupId == 5) {
            return array('ROLE_SPECIAL');
        }
    }

    public function getUsername()
    {
        return $this->apMail;
    }
    
    public function eraseCredentials()
    {
    }  
    
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->apLast,
            $this->apMail,
            $this->passpalabra,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->apLast,
            $this->apMail,
            $this->passpalabra,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
    
    /**
     * @var integer
     */
    private $groupId;


    /**
     * Set groupId
     *
     * @param integer $groupId
     * @return ArxfTeams
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * Get groupId
     *
     * @return integer 
     */
    public function getGroupId()
    {
        return $this->groupId;
    }
}
