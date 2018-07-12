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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Analysis", inversedBy="sheet")
     */
    private $analysis;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="sheet")
     */
    private $comments;

    /**
     * @var bool
     *
     * @ORM\Column(name="urgent", type="boolean", nullable=true)
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
     * @Assert\Date()
     * @ORM\Column(name="startWork", type="date")
     * @Assert\GreaterThanOrEqual("today")
     */
    private $startWork;

    /**
     *
     * @ORM\Column(name="endWork", type="date", nullable=true)
     * @Assert\Expression(
     *     "this.getEndWork() or value >= this.getStartWork()",
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
     * @Assert\Date()
     *
     * @ORM\Column(name="analysisDate", type="date", nullable=true)
     *
     */
    private $analysisDate;

    /**
     * @var string
     * @ORM\Column(name="contactPeople", type="text", nullable=true)
     */
    private $contactPeople;

    /**
     * @Assert\Date()
     * @ORM\Column(name="realStartWork", type="date", nullable=true)
     * @Assert\GreaterThanOrEqual("today")
     */
    private $realStartWork;

    /**
     * @Assert\Date()
     * @ORM\Column(name="realEndWork", type="date", nullable=true)
     *@Assert\Expression(
     *     "this.getRealEndWork() or value >= this.getRealStartWork()",
     *     message="La fin des travaux ne peut être postérieure au début."
     * )
     */
    private $realEndWork;

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
     * @param \DateTime $creationDate
     * @return Sheet
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * Get creationDate
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
     * Set analysisDate
     *
     * @param \DateTime $analysisDate
     *
     * @return Sheet
     */
    public function setAnalysisDate($analysisDate)
    {
        $this->analysisDate = $analysisDate;

        return $this;
    }

    /**
     * Get analysisDate
     *
     * @return \DateTime
     */
    public function getAnalysisDate()
    {
        return $this->analysisDate;
    }

     /**
     * Set analysis
     * @param \AppBundle\Entity\Analysis $analysis
     * @return Sheet
     */
    public function setAnalysis(\AppBundle\Entity\Analysis $analysis = null)
    {
        $this->analysis = $analysis;
        return $this;
    }

     /**
     * Get analysis
     * @return \AppBundle\Entity\Analysis
     */
    public function getAnalysis()
    {
        return $this->analysis;
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\Comment $comment
     *
     * @return Sheet
     */
    public function addComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\Comment $comment
     */
    public function removeComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set contactPeople
     *
     * @param string $contactPeople
     *
     * @return Sheet
     */
    public function setContactPeople($contactPeople)
    {
        $this->contactPeople = $contactPeople;

        return $this;
    }

    /**
     * Get contactPeople
     *
     * @return string
     */
    public function getContactPeople()
    {
        return $this->contactPeople;
    }

    /**
     * Set realStartWork
     *
     * @param \DateTime $realStartWork
     *
     * @return Sheet
     */
    public function setRealStartWork($realStartWork)
    {
        $this->realStartWork = $realStartWork;

        return $this;
    }

    /**
     * Get realStartWork
     *
     * @return \DateTime
     */
    public function getRealStartWork()
    {
        return $this->realStartWork;
    }

    /**
     * Set realEndWork
     *
     * @param \DateTime $realEndWork
     *
     * @return Sheet
     */
    public function setRealEndWork($realEndWork)
    {
        $this->realEndWork = $realEndWork;

        return $this;
    }

    /**
     * Get realEndWork
     *
     * @return \DateTime
     */
    public function getRealEndWork()
    {
        return $this->realEndWork;
    }
}
