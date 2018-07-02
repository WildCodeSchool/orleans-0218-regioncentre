<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table(name="department")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DepartmentRepository")
 */
class Department
{

    /**
     * add by ziadoof
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Lycee", mappedBy ="department")
     */
    private $lycees;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;


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
     * @ORM\Column(name="short_code", type="integer")
     */
    private $shortCode;

    /**
     * @var int
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="sheet")
     */
    private $user;

    /**
     * @return string
     * add by ziadoof
     */

    public function __toString()
    {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     *
     * @return Department
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
     * Set shortCode
     *
     * @param integer $shortCode
     *
     * @return Department
     */
    public function setShortCode($shortCode)
    {
        $this->shortCode = $shortCode;

        return $this;
    }

    /**
     * Get shortCode
     *
     * @return int
     */
    public function getShortCode()
    {
        return $this->shortCode;
    }

    /**
     * Set department
     *
     * @param \AppBundle\Entity\Lycee $department
     *
     * @return Department
     */
    public function setDepartment(\AppBundle\Entity\Lycee $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \AppBundle\Entity\Lycee
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set departments
     *
     * @param \AppBundle\Entity\Lycee $departments
     *
     * @return Department
     */
    public function setDepartments(\AppBundle\Entity\Lycee $departments = null)
    {
        $this->departments = $departments;

        return $this;
    }

    /**
     * Get departments
     *
     * @return \AppBundle\Entity\Lycee
     */
    public function getDepartments()
    {
        return $this->departments;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->department = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add department
     *
     * @param \AppBundle\Entity\Lycee $department
     *
     * @return Department
     */
    public function addDepartment(\AppBundle\Entity\Lycee $department)
    {
        $this->department[] = $department;

        return $this;
    }

    /**
     * Remove department
     *
     * @param \AppBundle\Entity\Lycee $department
     */
    public function removeDepartment(\AppBundle\Entity\Lycee $department)
    {
        $this->department->removeElement($department);
    }

    /**
     * Add departman.
     *
     * @param \AppBundle\Entity\Lycee $departman
     *
     * @return Department
     */
    public function addDepartman(\AppBundle\Entity\Lycee $departman)
    {
        $this->departmen[] = $departman;

        return $this;
    }

    /**
     * Remove departman.
     *
     * @param \AppBundle\Entity\Lycee $departman
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDepartman(\AppBundle\Entity\Lycee $departman)
    {
        return $this->departmen->removeElement($departman);
    }

    /**
     * Get departmen.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartmen()
    {
        return $this->departmen;
    }

    /**
     * Add lycee.
     *
     * @param \AppBundle\Entity\Lycee $lycee
     *
     * @return Department
     */
    public function addLycee(\AppBundle\Entity\Lycee $lycee)
    {
        $this->lycees[] = $lycee;

        return $this;
    }

    /**
     * Remove lycee.
     *
     * @param \AppBundle\Entity\Lycee $lycee
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeLycee(\AppBundle\Entity\Lycee $lycee)
    {
        return $this->lycees->removeElement($lycee);
    }

    /**
     * Get lycees.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLycees()
    {
        return $this->lycees;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Department
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }
}
