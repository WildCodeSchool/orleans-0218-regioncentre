<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le champs Prénom ne peu dépasser {{ limit }} caractères"
     * )
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le champ Fonction / Poste ne peu dépasser {{ limit }} caractères"
     * )
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="work", type="string", length=255)
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le champ Fonction / Poste ne peu dépasser {{ limit }} caractères"
     * )
     * @Assert\NotBlank()
     */
    private $work;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=30)
     *
     * @Assert\Length(
     *      min = 10,
     *      max = 30,
     *      maxMessage = "Le numéro ne peu dépasser {{ limit }} caractères",
     *      minMessage = "Le numéro doit comporter au moins {{ limit }} caractères")
     * @Assert\NotBlank()
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     *
     * @Assert\Email(
     *     message = "Le courriel '{{ value }}' ne respecte pas le format"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "L\'adresse courriel ne peu dépasser {{ limit }} caractères"
     * )
     * @Assert\NotBlank()
     */
    private $mail;

    /**
     * add by ziadoof
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Lycee")
     */
    private $lycee;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set work
     *
     * @param string $work
     *
     * @return User
     */
    public function setWork($work)
    {
        $this->work = $work;

        return $this;
    }

    /**
     * Get work
     *
     * @return string
     */
    public function getWork()
    {
        return $this->work;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLycee()
    {
        return $this->lycee;
    }

    /**
     * @param mixed $lycee
     */
    public function setLycee($lycee): void
    {
        $this->lycee = $lycee;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }
}
