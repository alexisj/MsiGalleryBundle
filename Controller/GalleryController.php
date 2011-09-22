<?php

namespace Msi\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Msi\GalleryBundle\Entity\Gallery;
use Symfony\Component\HttpFoundation\Response;


class GalleryController extends Controller
{
    
    public function indexAction()
    {
        $records = $this->getDoctrine()->getRepository('MsiGalleryBundle:GalleryImage')->findAll();
        return $this->render('MsiGalleryBundle:Gallery:index.html.twig', array('records' => $records));
    }
}
