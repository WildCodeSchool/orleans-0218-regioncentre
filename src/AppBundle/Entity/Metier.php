<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Metier
 *
 * @ORM\Table(name="metier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MetierRepository")
 */
class Metier
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
     * @ORM\Column(name="name", type="string", length=50)
     * @Assert\NotBlank(
     *     message="Le métier ne doit pas être vide.",
     * )
     * @Assert\Length(
     *     max = 50,
     * )
     * @Assert\Regex(
     *     pattern     = "/^[a-zçéè]+$/i",
     *     htmlPattern = "^[a-zA-Zçéè]+$",
     *     message="Le métier doit uniquement contenir des lettres.",
     * )
     */
    private $name;


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
     * Set name
     *
     * @param string $name
     *
     * @return Metier
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
}
