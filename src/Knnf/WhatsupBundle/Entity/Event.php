<?php

namespace Knnf\WhatsupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Knnf\WhatsupBundle\Entity\EventRepository")
 */
class Event
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
     * @ORM\JoinColumn(name="userid", referencedColumnName="id" )
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="orderlink", type="string", length=255)
     */
    private $orderlink;

    /**
     * @var integer
     *
     * @ORM\Column(name="activate", type="integer")
     */
    private $activate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datestart", type="date")
     */
    private $datestart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateend", type="date")
     */
    private $dateend;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hourstart", type="time")
     */
    private $hourstart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hourend", type="time")
     */
    private $hourend;

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
     * @return Event
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
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Event
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Event
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set orderlink
     *
     * @param string $orderlink
     * @return Event
     */
    public function setOrderlink($orderlink)
    {
        $this->orderlink = $orderlink;

        return $this;
    }

    /**
     * Get orderlink
     *
     * @return string 
     */
    public function getOrderlink()
    {
        return $this->orderlink;
    }

    /**
     * Set activate
     *
     * @param integer $activate
     * @return Event
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
     * Set datestart
     *
     * @param \DateTime $datestart
     * @return Event
     */
    public function setDatestart($datestart)
    {
        $this->datestart = $datestart;

        return $this;
    }

    /**
     * Get datestart
     *
     * @return \DateTime 
     */
    public function getDatestart()
    {
        return $this->datestart;
    }

    /**
     * Set dateend
     *
     * @param \DateTime $dateend
     * @return Event
     */
    public function setDateend($dateend)
    {
        $this->dateend = $dateend;

        return $this;
    }

    /**
     * Get dateend
     *
     * @return \DateTime 
     */
    public function getDateend()
    {
        return $this->dateend;
    }

    /**
     * Set hourstart
     *
     * @param \DateTime $hourstart
     * @return Event
     */
    public function setHourstart($hourstart)
    {
        $this->hourstart = $hourstart;

        return $this;
    }

    /**
     * Get hourstart
     *
     * @return \DateTime 
     */
    public function getHourstart()
    {
        return $this->hourstart;
    }

    /**
     * Set hourend
     *
     * @param \DateTime $hourend
     * @return Event
     */
    public function setHourend($hourend)
    {
        $this->hourend = $hourend;

        return $this;
    }

    /**
     * Get hourend
     *
     * @return \DateTime 
     */
    public function getHourend()
    {
        return $this->hourend;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     * @return Event
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
     * @return Event
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
     * Set user
     *
     * @param \Knnf\WhatsupBundle\Entity\User $user
     * @return Event
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
