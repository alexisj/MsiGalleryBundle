<?php

namespace Msi\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="gallery")
 * @ORM\Entity(repositoryClass="Msi\GalleryBundle\Entity\GalleryRepository")
 */
class Gallery
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="GalleryImage", mappedBy="Gallery")
     */
    private $galleryImages;

    /**
     * @Gedmo\Sluggable
     * @ORM\Column
     */
    private $name;

    /**
     * @Gedmo\Slug
     * @ORM\Column
     */
    private $slug;

     /**
     * @var timestamp $created
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * @var date $updated
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    public function __toString()
    {
        return $this->name;
    }
    
    public function __construct()
    {
        $this->galleryImages = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Add galleryImages
     *
     * @param Msi\GalleryBundle\Entity\GalleryImage $galleryImages
     */
    public function addGalleryImage(\Msi\GalleryBundle\Entity\GalleryImage $galleryImages)
    {
        $this->galleryImages[] = $galleryImages;
    }

    /**
     * Get galleryImages
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGalleryImages()
    {
        return $this->galleryImages;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
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
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}