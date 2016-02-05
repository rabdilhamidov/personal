<?php

namespace Demos\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\Column(name="sort", type="integer", nullable=true)
    */
    protected $sort;

    /**
     * @ORM\ManyToOne(targetEntity="Demos\BlogBundle\Entity\Group")
     * @ORM\JoinColumn(name="mygroups", referencedColumnName="id")
     */
    protected $mygroups;
    

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sort
     *
     * @param integer $sort
     *
     * @return User
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return integer
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set mygroups
     *
     * @param \Demos\BlogBundle\Entity\Group $mygroups
     *
     * @return User
     */
    public function setMygroups(\Demos\BlogBundle\Entity\Group $mygroups = null)
    {
        $this->mygroups = $mygroups;

        return $this;
    }

    /**
     * Get mygroups
     *
     * @return \Demos\BlogBundle\Entity\Group
     */
    public function getMygroups()
    {
        return $this->mygroups;
    }
}
