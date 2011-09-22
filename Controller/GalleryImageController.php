<?php

namespace Msi\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Msi\GalleryBundle\Entity\GalleryImage;
use Symfony\Component\HttpFoundation\Response;

class GalleryImageController extends Controller
{  
    public function indexAction($slug)
    {
        $gallery = $this->getDoctrine()->getRepository('MsiGalleryBundle:Gallery')->findBySlugWithGalleryImages($slug);
        return $this->render('MsiGalleryBundle:GalleryImage:index.html.twig', array('gallery' => $gallery));
    }
}
