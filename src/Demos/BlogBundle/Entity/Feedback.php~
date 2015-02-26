<?php
namespace Demos\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="feedback")
* @ORM\HasLifecycleCallbacks
*/
class Feedback {

/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
protected $id;

/**
* @ORM\Column(type="string", length=255)
*/
protected $email;

/**
* @ORM\Column(type="string", length=512)
*/
protected $mess;

/**
* @ORM\Column(type="datetime")
*/
protected $created_date;


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
     * Set email
     *
     * @param string $email
     * @return Feedback
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set mess
     *
     * @param string $mess
     * @return Feedback
     */
    public function setMess($mess)
    {
        $this->mess = $mess;

        return $this;
    }

    /**
     * Get mess
     *
     * @return string 
     */
    public function getMess()
    {
        return $this->mess;
    }

    /**
     * Set created_date
     *
     * @param \DateTime $createdDate
     * @return Feedback
     */
    public function setCreatedDate($createdDate)
    {
        $this->created_date = $createdDate;

        return $this;
    }

    /**
     * Get created_date
     *
     * @return \DateTime 
     */
    public function getCreatedDate()
    {
        return $this->created_date;
    }

     /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps()
    {
        if ($this->getCreatedDate() == null) {
            $this->setCreatedDate(new \DateTime('now'));
        } 
    }

    /**
     * Set form_id
     *
     * @param string $formId
     * @return Feedback
     */
    public function setFormId($formId)
    {
        $this->form_id = $formId;

        return $this;
    }

    /**
     * Get form_id
     *
     * @return string 
     */
    public function getFormId()
    {
        return $this->form_id;
    }
}
