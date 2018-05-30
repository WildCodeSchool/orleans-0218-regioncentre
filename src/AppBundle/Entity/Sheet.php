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
     * @ORM\Column(name="objectRequest", type="text")
     * @Assert\Length(
     *      min = 2,
     *      max = 5000,
     *      minMessage = "Longueur minimum de {{ limit }} caractères",
     *      maxMessage = "Longueur maximum de {{ limit }} caractères"
     * )
     * @Assert\NotNull(message="Le champ ne peut pas être vide !")
     * @Assert\NotBlank(message="Vous ne pouvez pas envoyer juste un espace !")
     */
    private $objectRequest;

    /**
     * @var string
     *
     * @ORM\Column(name="buildings", type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Longueur minimum de {{ limit }} caractères",
     *      maxMessage = "Longueur maximum de {{ limit }} caractères"
     * )
     * @Assert\NotNull(message="Le champ ne peut pas être vide !")
     * @Assert\NotBlank(message="Vous ne pouvez pas envoyer juste un espace !")
     */
    private $buildings;

    /**
     * @var string
     *
     * @ORM\Column(name="constraintsBuildings", type="text", nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 5000,
     *      minMessage = "Longueur minimum de {{ limit }} caractères",
     *      maxMessage = "Longueur maximum de {{ limit }} caractères"
     * )
     */
    private $constraintsBuildings;

    /**
     * @var string
     *
     * @ORM\Column(name="constraintsTechnicals", type="text", nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 5000,
     *      minMessage = "Longueur minimum de {{ limit }} caractères",
     *      maxMessage = "Longueur maximum de {{ limit }} caractères"
     * )
     */
    private $constraintsTechnicals;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\Length(
     *      min = 2,
     *      max = 5000,
     *      minMessage = "Longueur minimum de {{ limit }} caractères",
     *      maxMessage = "Longueur maximum de {{ limit }} caractères"
     * )
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
     * @Assert\Date()
     */
    private $endWork;


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
}
