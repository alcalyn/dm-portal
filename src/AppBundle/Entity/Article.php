<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @JMS\Groups({"article"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * 
     * @JMS\Groups({"article"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * 
     * @JMS\Groups({"article"})
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inserted_at", type="datetime")
     * 
     * @JMS\Groups({"article"})
     */
    private $insertedAt;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User")
     * 
     * @JMS\Groups({"article"})
     */
    private $proposedBy;

    public function __construct()
    {
        $this->insertedAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
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
     * Set description
     *
     * @param string $description
     *
     * @return Article
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
     * Set insertedAt
     *
     * @param \DateTime $insertedAt
     *
     * @return Article
     */
    public function setInsertedAt($insertedAt)
    {
        $this->insertedAt = $insertedAt;

        return $this;
    }

    /**
     * Get insertedAt
     *
     * @return \DateTime
     */
    public function getInsertedAt()
    {
        return $this->insertedAt;
    }

    /**
     * Set proposedBy
     *
     * @param \AppBundle\Entity\User $proposedBy
     *
     * @return Article
     */
    public function setProposedBy(\AppBundle\Entity\User $proposedBy = null)
    {
        $this->proposedBy = $proposedBy;

        return $this;
    }

    /**
     * Get proposedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getProposedBy()
    {
        return $this->proposedBy;
    }
}
