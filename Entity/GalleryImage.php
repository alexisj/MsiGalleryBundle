<?php

namespace Msi\GalleryBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Msi\GalleryBundle\Imaginal\Imaginal;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="gallery_image")
 * @ORM\Entity(repositoryClass="Msi\GalleryBundle\Entity\GalleryImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class GalleryImage
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="gallery_id", type="integer")
     */
    private $galleryId;

    /**
     * @ORM\ManyToOne(targetEntity="Gallery")
     */
    private $gallery;

    /**
     * @ORM\Column
     */
    private $title;

    /**
     * @ORM\Column
     */
    private $filename;

    protected $file = null;

    public function __toString()
    {
        return $this->title;
    }

    protected function getUploadDir()
    {
        return __DIR__.'/../../../../web/uploads/gallery';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if ($this->file !== null)
            $this->setFilename(uniqid().'.'.$this->file->guessExtension());
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function postUpload()
    {
        if ($this->file !== null) {
            $this->file->move($this->getUploadDir(), $this->getFilename());
            // Make thumb.
            $im = new Imaginal($this->getUploadDir(), $this->getFilename());
            $im->resize(150);
            $im->save('t_');
        }

        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        unlink($this->upload_dir.$this->getFilename());
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
     * Set galleryId
     *
     * @param integer $galleryId
     */
    public function setGalleryId($galleryId)
    {
        $this->galleryId = $galleryId;
    }

    /**
     * Get galleryId
     *
     * @return integer 
     */
    public function getGalleryId()
    {
        return $this->galleryId;
    }

    /**
     * Set file
     *
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set gallery
     *
     * @param Msi\GalleryBundle\Entity\Gallery $gallery
     */
    public function setGallery(\Msi\GalleryBundle\Entity\Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * Get gallery
     *
     * @return Msi\GalleryBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set filename
     *
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
}