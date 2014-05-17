<?php

namespace Knnf\WhatsupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
        $this->activate =1; // Par défaut, la date de création est la date d'aujourd'hui
        $this->status = 1; // Par défaut, la date de création est la date d'aujourd'hui
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;


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
     * @var integer
     *
     * @ORM\Column(name="sandbox", type="integer")
     */
    private $sandbox;

    /**
     * @var integer
     *
     * @ORM\Column(name="views", type="integer")
     */
    private $views;

    /**
     * @var boolean
     *
     * @ORM\Column(name="push", type="boolean")
     */
    private $push;

     /**
     *
     * @Assert\File(maxSize="6000000")
     */
    public $file;


     
     /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255,nullable=true)
     */
    public $path;

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/documents';
    }

    

    public function upload()
    {
        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->file) {
            return;
        }

        // utilisez le nom de fichier original ici mais
        // vous devriez « l'assainir » pour au moins éviter
        // quelconques problèmes de sécurité

        // la méthode « move » prend comme arguments le répertoire cible et
        // le nom de fichier cible où le fichier doit être déplacé
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        // définit la propriété « path » comme étant le nom de fichier où vous
        // avez stocké le fichier
        $this->path = $this->file->getClientOriginalName();

        // « nettoie » la propriété « file » comme vous n'en aurez plus besoin
        $this->file = null;
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

    /**
     * Set views
     *
     * @param string $views
     * @return Article
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return string 
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set push
     *
     * @param integer $push
     * @return Article
     */
    public function setPush($push)
    {
        $this->push = $push;

        return $this;
    }

    /**
     * Get push
     *
     * @return integer 
     */
    public function getPush()
    {
        return $this->push;
    }

    /**
     * Set sandbox
     *
     * @param integer $sandbox
     * @return Article
     */
    public function setSandbox($sandbox)
    {
        $this->sandbox = $sandbox;

        return $this;
    }

    /**
     * Get sandbox
     *
     * @return integer 
     */
    public function getSandbox()
    {
        return $this->sandbox;
    }
}
