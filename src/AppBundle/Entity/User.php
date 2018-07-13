<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 *
 */
class User extends BaseUser
{
    /**
     * @param ExecutionContextInterface $context
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (in_array('ROLE_EMOP', $this->getRoles()) and !$this->getDepartments()) {
            $context->buildViolation('L\'utilisateur EMOP doit être relié à au moins un département !')
                ->addViolation();
        }

        if (in_array('ROLE_EMOP', $this->getRoles()) and $this->getLycee()) {
            $context->buildViolation('L\'utilisateur EMOP ne doit pas être relié à un lycée !')
                ->addViolation();
        }


        if (in_array('ROLE_LYCEE', $this->getRoles()) and !$this->getLycee()) {
            $context->buildViolation('L\'utilisateur LYCEE doit être relié à au moins un lycée !')
                ->addViolation();
        }

        if (in_array('ROLE_LYCEE', $this->getRoles()) and
            (!empty($this->getDepartments()) && !$this->getDepartments()->isEmpty())) {
            $context->buildViolation('L\'utilisateur LYCEE ne doit pas être relié à un département !')
                ->addViolation();
        }
        if (in_array('ROLE_ADMIN', $this->getRoles()) and
            ((!empty($this->getDepartments()) && !$this->getDepartments()->isEmpty()) or $this->getLycee())) {
            $context->buildViolation('L\'utilisateur ADMIN ne doit pas être relié à un département ou à un lycée!')
                ->addViolation();
        }
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="user")
     */
    private $comments;

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
     *
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "L\'adresse courriel ne peu dépasser {{ limit }} caractères"
     * )
     * @Assert\NotBlank()
     */
    private $mail;

    /**
     * add by ziadoof
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Lycee" )
     */
    private $lycee;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Department", inversedBy="users")
     */
    private $departments;

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
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\Comment $comment
     *
     * @return User
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
     * Set lycee.
     *
     * @param \AppBundle\Entity\Lycee|null $lycee
     *
     * @return User
     */
    public function setLycee(\AppBundle\Entity\Lycee $lycee = null)
    {
        $this->lycee = $lycee;

        return $this;
    }

    /**
     * Get lycee.
     *
     * @return \AppBundle\Entity\Lycee|null
     */
    public function getLycee()
    {
        return $this->lycee;
    }


    /**
     * Add department
     *
     * @param \AppBundle\Entity\Department $department
     *
     * @return User
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
}
