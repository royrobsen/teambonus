<?php

namespace Team\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpPosts
 */
class WpPosts
{
    /**
     * @var integer
     */
    private $postAuthor;

    /**
     * @var \DateTime
     */
    private $postDate;

    /**
     * @var string
     */
    private $postContent;

    /**
     * @var string
     */
    private $postTitle;

    /**
     * @var string
     */
    private $postStatus;

    /**
     * @var string
     */
    private $postMimeType;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set postAuthor
     *
     * @param integer $postAuthor
     * @return WpPosts
     */
    public function setPostAuthor($postAuthor)
    {
        $this->postAuthor = $postAuthor;

        return $this;
    }

    /**
     * Get postAuthor
     *
     * @return integer 
     */
    public function getPostAuthor()
    {
        return $this->postAuthor;
    }

    /**
     * Set postDate
     *
     * @param \DateTime $postDate
     * @return WpPosts
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get postDate
     *
     * @return \DateTime 
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * Set postContent
     *
     * @param string $postContent
     * @return WpPosts
     */
    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;

        return $this;
    }

    /**
     * Get postContent
     *
     * @return string 
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * Set postTitle
     *
     * @param string $postTitle
     * @return WpPosts
     */
    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;

        return $this;
    }

    /**
     * Get postTitle
     *
     * @return string 
     */
    public function getPostTitle()
    {
        return $this->postTitle;
    }

    /**
     * Set postStatus
     *
     * @param string $postStatus
     * @return WpPosts
     */
    public function setPostStatus($postStatus)
    {
        $this->postStatus = $postStatus;

        return $this;
    }

    /**
     * Get postStatus
     *
     * @return string 
     */
    public function getPostStatus()
    {
        return $this->postStatus;
    }

    /**
     * Set postMimeType
     *
     * @param string $postMimeType
     * @return WpPosts
     */
    public function setPostMimeType($postMimeType)
    {
        $this->postMimeType = $postMimeType;

        return $this;
    }

    /**
     * Get postMimeType
     *
     * @return string 
     */
    public function getPostMimeType()
    {
        return $this->postMimeType;
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

    private $allField;
    
    /**
     * Set allFields
     *
     * @param string allField
     * @return WpPosts
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
