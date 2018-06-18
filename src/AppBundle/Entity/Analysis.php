<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Analysis
 *
 * @ORM\Table(name="analysis")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnalysisRepository")
 */
class Analysis
{
    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Statut")
     */
    private $status;

    /*******************/
    /* AUTOGENERATED */
    /***************/

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, unique=true)
     *
     * @Assert\length(
     *     min = 2,
     *     max = 64,
     *      minMessage = "Le texte doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le texte ne peu dépasser {{ limit }} caractères"
     * )
     * @Assert\NotBlank()
     */
    private $name;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Analysis
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set status.
     *
     * @param string|null $status
     *
     * @return Analysis
     */
    public function setStatus($status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }
}