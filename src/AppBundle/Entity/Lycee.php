<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lycee
 *
 * @ORM\Table(name="lycee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LyceeRepository")
 */
class Lycee
{

    /**
     * add by ziadoof
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Department", inversedBy="lycees")
     * @ORM\JoinColumn(nullable=true)
     */
    private $department;

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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Le nom du site doit être d'au moins {{ limit }} caractères",
     *
     * )
     * @Assert\NotNull(message="Le champ ne peut pas être vide !")
     * @Assert\NotBlank(message="Vous ne pouvez pas envoyer juste un espace !")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "L'adresse doit être d'au moins {{ limit }} caractères",
     * )
     * @Assert\NotNull(message="Le champ ne peut pas être vide !")
     * @Assert\NotBlank(message="Vous ne pouvez pas envoyer juste un espace !")
     */
    private $address;

    /**
     * @var int
     *
     * @ORM\Column(name="postal_code", type="integer")
     * @Assert\Type(
     *     type="numeric",
     *     message="La valeur {{ value }} n'est pas un format de code postal."
     * )
     * @Assert\Regex(
     *     pattern     ="#^[0-9]{5}$#",
     *     htmlPattern = "#^[0-9]{5}$#"
     * )
     *
     *
     * @Assert\NotNull(message="Le champ ne peut pas être vide !")
     * @Assert\NotBlank(message="Vous ne pouvez pas envoyer juste un espace !")
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     *@Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Le nom de la ville doit être d'au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de la ville ne peut pas dépasser les {{limit}} caractères "
     * )
     * @Assert\NotNull(message="Le champ ne peut pas être vide !")
     * @Assert\NotBlank(message="Vous ne pouvez pas envoyer juste un espace !")
     */
    private $city;


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
     * @return Lycee
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
     * Set address
     *
     * @param string $address
     *
     * @return Lycee
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
     * Set postalCode
     *
     * @param integer $postalCode
     *
     * @return Lycee
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return int
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Lycee
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set department
     *
     * @param \AppBundle\Entity\Department $department
     *
     * @return Lycee
     */
    public function setDepartment(\AppBundle\Entity\Department $department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \AppBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add department
     *
     * @param \AppBundle\Entity\Department $department
     *
     * @return Lycee
     */
    public function addDepartment(\AppBundle\Entity\Department $department)
    {
        $this->departments[] = $department;

        return $this;
    }

    /**
     * Remove department
     *
     * @param \AppBundle\Entity\Department $department
     */
    public function removeDepartment(\AppBundle\Entity\Department $department)
    {
        $this->departments->removeElement($department);
    }

    /**
     * Get departments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * Set departments
     *
     * @param \AppBundle\Entity\Department $departments
     *
     * @return Lycee
     */
    public function setDepartments(\AppBundle\Entity\Department $departments)
    {
        $this->departments = $departments;

        return $this;
    }

    /**
     * Set lycees.
     *
     * @param \AppBundle\Entity\Department|null $lycees
     *
     * @return Lycee
     */
    public function setLycees(\AppBundle\Entity\Department $lycees = null)
    {
        $this->lycees = $lycees;

        return $this;
    }

    /**
     * Get lycees.
     *
     * @return \AppBundle\Entity\Department|null
     */
    public function getLycees()
    {
        return $this->lycees;
    }
}
