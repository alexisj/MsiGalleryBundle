<?php

namespace Msi\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Msi\GalleryBundle\Entity\Gallery;
use Symfony\Component\HttpFoundation\Response;

class GalleryController extends Controller
{
    public function indexAction()
    {
        $galleries = $this->getDoctrine()->getRepository('MsiGalleryBundle:Gallery')->findAll();
        return $this->render('MsiGalleryBundle:Gallery:index.html.twig', array('galleries' => $galleries));
    }
}
