<?php
namespace Demos\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="post")
* @ORM\Entity(repositoryClass="Demos\BlogBundle\Entity\Repository\PostRepository")
* @ORM\HasLifecycleCallbacks
*/
class Post {

/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
protected $id;

/**
* @ORM\Column(type="string", length=255, nullable=true)
*/
protected $title;

/**
* @ORM\Column(name="titleEn", type="string", length=255, nullable=true)
*/
protected $titleEn;

/**
* @ORM\Column(name="sort", type="integer", nullable=true)
*/
protected $sort;

/**
* @ORM\Column(name="slug", type="string", length=255, nullable=true)
*/
protected $slug;

/**
* @ORM\Column(name="weblink", type="string", length=255, nullable=true)
*/
protected $weblink;


/**
 * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="posts")
 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
 */
public $user;

/**
* @ORM\Column(type="text", nullable=true)
*/
protected $body;

/**
* @ORM\Column(name="bodyEn", type="text", nullable=true)
*/
protected $bodyEn;

/**
* @ORM\Column(type="datetime")
*/
protected $created_date;

/**
* @ORM\Column(type="datetime")
*/
protected $updated_date;

/**
 * @ORM\ManyToOne(targetEntity="Category", inversedBy="post")
 * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
 */
protected $category;

/**
 * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade="all")
 * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
 */
protected $image;


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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Post
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
        // if(!$this->body){
        //     $this->body = "default body";
        // }
        return $this->body;
    }

    /**
     * Set created_date
     *
     * @param \DateTime $createdDate
     * @return Post
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
     * @return Post
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
     * Set category
     *
     * @param \Demos\BlogBundle\Entity\Category $category
     * @return Post
     */
    public function setCategory(\Demos\BlogBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Demos\BlogBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set author
     *
     * @param \Demos\BlogBundle\Entity\User $author
     * @return Post
     */
    public function setAuthor(\Application\Sonata\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Demos\BlogBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set image
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return Post
     */
    public function setImage(\Application\Sonata\MediaBundle\Entity\Media $image = null)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get image
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getImage()
    {
        return $this->image;
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


    /**
     * Set weblink
     *
     * @param string $weblink
     * @return Post
     */
    public function setWeblink($weblink)
    {
        $this->weblink = $weblink;

        return $this;
    }

    /**
     * Get weblink
     *
     * @return string 
     */
    public function getWeblink()
    {
        return $this->weblink;
    }

    /**
     * Set sort
     *
     * @param integer $sort
     * @return Post
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
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Post
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set title_en
     *
     * @param string $titleEn
     * @return Post
     */
    public function setTitleEn($titleEn)
    {
        $this->title_en = $titleEn;

        return $this;
    }

    /**
     * Get title_en
     *
     * @return string 
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * Set body_en
     *
     * @param string $bodyEn
     * @return Post
     */
    public function setBodyEn($bodyEn)
    {
        $this->bodyEn = $bodyEn;

        return $this;
    }

    /**
     * Get body_en
     *
     * @return string 
     */
    public function getBodyEn()
    {
        return $this->bodyEn;
    }
}
