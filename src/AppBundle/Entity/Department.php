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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Lycee", mappedBy ="departments")
     */
    private $department;

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
     * @ORM\Column(name="chort_code", type="integer")
     */
    private $chortCode;


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
     * Set chortCode
     *
     * @param integer $chortCode
     *
     * @return Department
     */
    public function setChortCode($chortCode)
    {
        $this->chortCode = $chortCode;

        return $this;
    }

    /**
     * Get chortCode
     *
     * @return int
     */
    public function getChortCode()
    {
        return $this->chortCode;
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
}
