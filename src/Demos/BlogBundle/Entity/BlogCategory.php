<?php
namespace Demos\BlogBundle\Entity;


use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="blogcategories")
 * use repository for handy tree functions
 * @ORM\Entity(repositoryClass="Demos\BlogBundle\Entity\Repository\BlogCategoryRepository")
 */
class BlogCategory
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="sort", type="integer", nullable=true)
     */
    private $sort;

    /**
     * @ORM\Column(name="title", type="string", length=128)
     */
    private $title;

    /**
     * @ORM\Column(name="title_en", type="string", length=128)
     */
    private $title_en;

    /**
     * @ORM\Column(name="slug", type="string", length=128)
     */
    private $slug;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="BlogCategory", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="BlogCategory", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="category")
     */
    protected $post;


    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setParent(BlogCategory $parent = null)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return BlogCategory
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return BlogCategory
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return BlogCategory
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer 
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return BlogCategory
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Add children
     *
     * @param \Demos\BlogBundle\Entity\BlogCategory $children
     * @return BlogCategory
     */
    public function addChild(\Demos\BlogBundle\Entity\BlogCategory $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Demos\BlogBundle\Entity\BlogCategory $children
     */
    public function removeChild(\Demos\BlogBundle\Entity\BlogCategory $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add post
     *
     * @param \Demos\BlogBundle\Entity\BlogPost $post
     * @return BlogCategory
     */
    public function addPost(\Demos\BlogBundle\Entity\BlogPost $post)
    {
        $this->post[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \Demos\BlogBundle\Entity\BlogPost $post
     */
    public function removePost(\Demos\BlogBundle\Entity\BlogPost $post)
    {
        $this->post->removeElement($post);
    }

    /**
     * Get post
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPost()
    {
        return $this->post;
    }

    public function __toString() {
        // Show name if it exist otherwise just show a custom label
        return $this->title ? $this->title : 'no title';
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return BlogCategory
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
     * Set sort
     *
     * @param integer $sort
     * @return BlogCategory
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
     * Set title_en
     *
     * @param string $titleEn
     * @return BlogCategory
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
        return $this->title_en;
    }
}
