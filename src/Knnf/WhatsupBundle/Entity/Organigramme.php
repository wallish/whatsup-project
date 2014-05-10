<?php

namespace Knnf\WhatsupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organigramme
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Knnf\WhatsupBundle\Entity\OrganigrammeRepository")
 */
class Organigramme
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="userlist", type="text")
     */
    private $userlist;


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
     * Set name
     *
     * @param string $name
     * @return Organigramme
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set userlist
     *
     * @param string $userlist
     * @return Organigramme
     */
    public function setUserlist($userlist)
    {
        $this->userlist = $userlist;

        return $this;
    }

    /**
     * Get userlist
     *
     * @return string 
     */
    public function getUserlist()
    {
        return $this->userlist;
    }
}
