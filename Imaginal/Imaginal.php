<?php

namespace Msi\GalleryBundle\Imaginal;

use Symfony\Component\HttpFoundation\File\Exception\FileException;

class Imaginal
{
    private $srcImage;
    private $srcW;
    private $srcH;
    private $newImage;
    private $dir;
    private $filename;
    private $ext;

    public function __construct($dir, $filename)
    {
        if (!extension_loaded('gd'))
            throw new FileException('GD library is not enabled.');

        $ext = strtolower(substr(strrchr($filename,'.'),1));

        if ($ext === 'jpg' || $ext === 'jpeg') {
            $srcImage = imagecreatefromjpeg($dir.'/'.$filename);
        } else if ($ext === 'png') {
            $srcImage = imagecreatefrompng($dir.'/'.$filename);
        } else if ($ext === 'gif') {
            $srcImage = imagecreatefromgif($dir.'/'.$filename);
        } else {
            throw new FileException('File must be either jpeg or png or gif.');
        }

        $this->srcW = imagesx($srcImage);
        $this->srcH = imagesy($srcImage);
        $this->srcImage = $srcImage;
        $this->filename = $filename;
        $this->dir = $dir;
        $this->ext = $ext;
    }

    public function resize($a)
    {
        if ($this->srcH < $this->srcW) {
            $ratio = $this->srcH / $a;
            $h = $this->srcH / $ratio;
            $w = $this->srcW / $ratio;
        } else if ($this->srcH > $this->srcW) {
            $ratio = $this->srcW / $a;
            $h = $this->srcH / $ratio;
            $w = $this->srcW / $ratio;
        } else {
            $h = $a;
            $w = $a;
        }

        $image = imagecreatetruecolor($w, $h);
        
        imagecopyresampled($image, $this->srcImage, 0, 0, 0, 0, $w, $h, $this->srcW, $this->srcH);

        $this->newImage = $image;
    }

    public function save($prefix)
    {
        if ($this->ext === 'png')
            return imagepng($this->newImage, $this->dir.'/'.$prefix.$this->filename, 0);
        else if ($this->ext === 'gif')
            return imagegif($this->newImage, $this->dir.'/'.$prefix.$this->filename);
        else
            return imagejpeg($this->newImage, $this->dir.'/'.$prefix.$this->filename, 100);
    }
}