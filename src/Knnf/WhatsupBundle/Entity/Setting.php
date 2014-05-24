<?php

namespace Knnf\WhatsupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Setting
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Knnf\WhatsupBundle\Entity\SettingRepository")
 */
class Setting
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Knnf\WhatsupBundle\Entity\User")
     * @ORM\JoinColumn(name="userid", referencedColumnName="id",unique=false )
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Knnf\WhatsupBundle\Entity\Category")
     * @ORM\JoinColumn(name="categoryid", referencedColumnName="id",unique=false )
     */
    private $category;

        /**
     * @ORM\ManyToOne(targetEntity="Knnf\WhatsupBundle\Entity\Category")
     * @ORM\JoinColumn(name="categoryid2", referencedColumnName="id",unique=false )
     */
    private $category2;

    /**
     * @ORM\ManyToOne(targetEntity="Knnf\WhatsupBundle\Entity\Category")
     * @ORM\JoinColumn(name="categoryid3", referencedColumnName="id",unique=false )
     */
    private $category3;

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
     * Set category
     *
     * @param \Knnf\WhatsupBundle\Entity\Category $category
     * @return Article
     */
    public function setCategory2(\Knnf\WhatsupBundle\Entity\Category $category = null)
    {
        $this->category2 = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Knnf\WhatsupBundle\Entity\Category 
     */
    public function getCategory2()
    {
        return $this->category2;
    }

        /**
     * Set category
     *
     * @param \Knnf\WhatsupBundle\Entity\Category $category
     * @return Article
     */
    public function setCategory3(\Knnf\WhatsupBundle\Entity\Category $category = null)
    {
        $this->category3 = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Knnf\WhatsupBundle\Entity\Category 
     */
    public function getCategory3()
    {
        return $this->category3;
    }
}
