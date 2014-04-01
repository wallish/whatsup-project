<?php

namespace Knnf\WhatsupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Knnf\WhatsupBundle\Entity\ArticleRepository")
 */
class Article
{

    public function __construct()
    {
        $this->dateinsert = new \Datetime(); // Par défaut, la date de création est la date d'aujourd'hui
        $this->dateupdate = new \Datetime(); // Par défaut, la date de création est la date d'aujourd'hui
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Knnf\WhatsupBundle\Entity\Category")
     * @ORM\JoinColumn(name="categoryid", referencedColumnName="id",unique=false )
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Knnf\WhatsupBundle\Entity\User")
     * @ORM\JoinColumn(name="userid", referencedColumnName="id",unique=false )
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateinsert", type="datetime")
     */
    private $dateinsert;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateupdate", type="datetime")
     */
    private $dateupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="activate", type="integer")
     */
    private $activate;


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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Article
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Article
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Article
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     * @return Article
     */
    public function setDateinsert($dateinsert)
    {
        $this->dateinsert = $dateinsert;

        return $this;
    }

    /**
     * Get dateinsert
     *
     * @return \DateTime 
     */
    public function getDateinsert()
    {
        return $this->dateinsert;
    }

    /**
     * Set dateupdate
     *
     * @param \DateTime $dateupdate
     * @return Article
     */
    public function setDateupdate($dateupdate)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate
     *
     * @return \DateTime 
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

    /**
     * Set activate
     *
     * @param integer $activate
     * @return Article
     */
    public function setActivate($activate)
    {
        $this->activate = $activate;

        return $this;
    }

    /**
     * Get activate
     *
     * @return integer 
     */
    public function getActivate()
    {
        return $this->activate;
    }

    /**
     * Set category
     *
     * @param \Knnf\WhatsupBundle\Entity\Category $category
     * @return Article
     */
    public function setCategory(\Knnf\WhatsupBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Knnf\WhatsupBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set user
     *
     * @param \Knnf\WhatsupBundle\Entity\User $user
     * @return Article
     */
    public function setUser(\Knnf\WhatsupBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Knnf\WhatsupBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
