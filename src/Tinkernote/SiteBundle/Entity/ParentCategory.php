<?php

namespace Tinkernote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parentscategory
 *
 * @ORM\Table(name="parentscategory")
 * @ORM\Entity(repositoryClass="Tinkernote\SiteBundle\Entity\ParentCategoryRepository")
 */
class ParentCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="parent", type="string", length=255)
     */
    private $parent;

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
     * Set parent
     *
     * @param string $parent
     * @return ParentCategory
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return string 
     */
    public function getParent()
    {
        return $this->parent;
    }
}
