<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sheet
 *
 * @ORM\Table(name="sheet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SheetRepository")
 */
class Sheet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="urgent", type="boolean")
     * @Assert\Choice({1,0})
     */
    private $urgent;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="text")
     * @Assert\NotNull(message="Le champ ne peut pas être vide !")
     * @Assert\NotBlank(message="Vous ne pouvez pas envoyer juste un espace !")
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="buildings", type="string", length=255)
     * @Assert\NotNull(message="Le champ ne peut pas être vide !")
     * @Assert\NotBlank(message="Vous ne pouvez pas envoyer juste un espace !")
     */
    private $buildings;

    /**
     * @var string
     *
     * @ORM\Column(name="constraintsBuildings", type="text", nullable=true)
     */
    private $constraintsBuildings;

    /**
     * @var string
     *
     * @ORM\Column(name="constraintsTechnicals", type="text", nullable=true)
     */
    private $constraintsTechnicals;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotNull(message="Le champ ne peut pas être vide !")
     * @Assert\NotBlank(message="Vous ne pouvez pas envoyer juste un espace !")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startWork", type="date")
     * @Assert\Date()
     */
    private $startWork;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endWork", type="date", nullable=true)
     * @Assert\Expression(
     *     "this.getEndWork() in ['php', 'symfony'] or value >= this.getStartWork()",
     *     message="La fin des travaux ne peut être postérieure au début."
     * )
     * @Assert\Date()
     */
    private $endWork;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Metier")
     * @var int
     */
    private $job;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Statut")
     * @var int
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @var int
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="date")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="analyseDate", type="datetime", nullable=true)
     */
    private $analyseDate;

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
     * Set urgent
     *
     * @param boolean $urgent
     *
     * @return Sheet
     */
    public function setUrgent($urgent)
    {
        $this->urgent = $urgent;

        return $this;
    }

    /**
     * Get urgent
     *
     * @return bool
     */
    public function getUrgent()
    {
        return $this->urgent;
    }

    /**
     * Set objectRequest
     *
     * @param string $objectRequest
     *
     * @return Sheet
     */
    public function setObjectRequest($objectRequest)
    {
        $this->objectRequest = $objectRequest;

        return $this;
    }

    /**
     * Get objectRequest
     *
     * @return string
     */
    public function getObjectRequest()
    {
        return $this->objectRequest;
    }

    /**
     * Set buildings
     *
     * @param string $buildings
     *
     * @return Sheet
     */
    public function setBuildings($buildings)
    {
        $this->buildings = $buildings;

        return $this;
    }

    /**
     * Get buildings
     *
     * @return string
     */
    public function getBuildings()
    {
        return $this->buildings;
    }

    /**
     * Set constraintsBuildings
     *
     * @param string $constraintsBuildings
     *
     * @return Sheet
     */
    public function setConstraintsBuildings($constraintsBuildings)
    {
        $this->constraintsBuildings = $constraintsBuildings;

        return $this;
    }

    /**
     * Get constraintsBuildings
     *
     * @return string
     */
    public function getConstraintsBuildings()
    {
        return $this->constraintsBuildings;
    }

    /**
     * Set constraintsTechnicals
     *
     * @param string $constraintsTechnicals
     *
     * @return Sheet
     */
    public function setConstraintsTechnicals($constraintsTechnicals)
    {
        $this->constraintsTechnicals = $constraintsTechnicals;

        return $this;
    }

    /**
     * Get constraintsTechnicals
     *
     * @return string
     */
    public function getConstraintsTechnicals()
    {
        return $this->constraintsTechnicals;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Sheet
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
     * Set startWork
     *
     * @param \DateTime $startWork
     *
     * @return Sheet
     */
    public function setStartWork($startWork)
    {
        $this->startWork = $startWork;

        return $this;
    }

    /**
     * Get startWork
     *
     * @return \DateTime
     */
    public function getStartWork()
    {
        return $this->startWork;
    }

    /**
     * Set endWork
     *
     * @param \DateTime $endWork
     *
     * @return Sheet
     */
    public function setEndWork($endWork)
    {
        $this->endWork = $endWork;

        return $this;
    }

    /**
     * Get endWork
     *
     * @return \DateTime
     */
    public function getEndWork()
    {
        return $this->endWork;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Sheet
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set status
     *
     * @param \AppBundle\Entity\Statut $status
     *
     * @return Sheet
     */
    public function setStatus(\AppBundle\Entity\Statut $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\Statut
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set job
     *
     * @param \AppBundle\Entity\Metier $job
     *
     * @return Sheet
     */
    public function setJob(\AppBundle\Entity\Metier $job = null)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return \AppBundle\Entity\Metier
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Sheet
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Sheet
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function __construct()
    {
        $this->setCreationDate(new \DateTime('now'));
    }

    /**
     * Set analyseDate
     *
     * @param \DateTime $analyseDate
     *
     * @return Sheet
     */
    public function setAnalyseDate($analyseDate)
    {
        $this->analyseDate = $analyseDate;

        return $this;
    }

    /**
     * Get analyseDate
     *
     * @return \DateTime
     */
    public function getAnalyseDate()
    {
        return $this->analyseDate;
    }
}
