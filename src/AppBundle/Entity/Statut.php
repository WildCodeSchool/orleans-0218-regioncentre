<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Statut
 *
 * @ORM\Table(name="statut")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatutRepository")
 */
class Statut
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(
     *     message="Le statut ne doit pas être vide.",
     * )
     * @Assert\Length(
     *     max = 30,
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Un code est nécessaire",
     * )
     *
     * @ORM\Column(name="code", type="string", length=64)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=7)
     * @Assert\Regex(
     *     pattern     = "/^#(?:(?:[a-f\d]{3}){1,2})$/i",
     *     htmlPattern = "#(?:(?:[a-f\d]{3}){1,2})$",
     *     message="Code couleur non valide",
     * )
     */
    private $color;

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
     *
     * @return Statut
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
     * Set code
     *
     * @param string $code
     *
     * @return Statut
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Statut
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }
}
