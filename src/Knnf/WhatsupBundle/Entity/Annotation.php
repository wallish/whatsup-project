<?php

namespace Knnf\WhatsupBundle\Entity;
use Knnf\WhatsupBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annotation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Knnf\WhatsupBundle\Entity\AnnotationRepository")
 */
class Annotation
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer")
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="idArticle", type="integer")
     */
    private $idArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="AnnotationType", type="string", length=50)
     */
    private $AnnotationType;

    /**
     * @var string
     *
     * @ORM\Column(name="AnnotationContent", type="text")
     */
    private $AnnotationContent;


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
     * Set idUser
     *
     * @param integer $idUser
     * @return Annotation
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idArticle
     *
     * @param integer $idArticle
     * @return Annotation
     */
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    /**
     * Get idArticle
     *
     * @return integer 
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Set AnnotationType
     *
     * @param string $annotationType
     * @return Annotation
     */
    public function setAnnotationType($annotationType)
    {
        $this->AnnotationType = $annotationType;

        return $this;
    }

    /**
     * Get AnnotationType
     *
     * @return string 
     */
    public function getAnnotationType()
    {
        return $this->AnnotationType;
    }

    /**
     * Set AnnotationContent
     *
     * @param string $annotationContent
     * @return Annotation
     */
    public function setAnnotationContent($annotationContent)
    {
        $this->AnnotationContent = $annotationContent;

        return $this;
    }

    /**
     * Get AnnotationContent
     *
     * @return string 
     */
    public function getAnnotationContent()
    {
        return $this->AnnotationContent;
    }

    /**
     * Set user
     *
     * @param \Knnf\WhatsupBundle\Entity\User $user
     * @return Annotation
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
