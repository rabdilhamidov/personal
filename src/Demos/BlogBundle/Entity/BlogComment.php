<?php
namespace Demos\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="blogcomment")
* @ORM\Entity(repositoryClass="Demos\BlogBundle\Entity\Repository\BlogCommentRepository")
* @ORM\HasLifecycleCallbacks
*/
class BlogComment {

/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
protected $id;

/**
 * @ORM\ManyToOne(targetEntity="Demos\BlogBundle\Entity\User")
 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
 */
protected $user;

/**
* @ORM\Column(type="text", nullable=true)
*/
protected $body;

/**
* @ORM\Column(type="datetime")
*/
protected $created_date;

/**
* @ORM\Column(type="datetime")
*/
protected $updated_date;

/**
* @ORM\Column(name="post", type="integer", nullable=true)
*/
protected $post;


   

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
     * Set body
     *
     * @param string $body
     * @return BlogComment
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set created_date
     *
     * @param \DateTime $createdDate
     * @return BlogComment
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
     * Set updated_date
     *
     * @param \DateTime $updatedDate
     * @return BlogComment
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updated_date = $updatedDate;

        return $this;
    }

    /**
     * Get updated_date
     *
     * @return \DateTime 
     */
    public function getUpdatedDate()
    {
        return $this->updated_date;
    }

    /**
     * Set post
     *
     * @param integer $post
     * @return BlogComment
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return integer 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set user
     *
     * @param \Demos\BlogBundle\Entity\User $user
     * @return BlogComment
     */
    public function setUser(\Demos\BlogBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Demos\BlogBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

     /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps()
    {
        $this->setUpdatedDate(new \DateTime('now'));
        if ($this->getCreatedDate() == null) {
            $this->setCreatedDate(new \DateTime('now'));
        } 
    }
}
