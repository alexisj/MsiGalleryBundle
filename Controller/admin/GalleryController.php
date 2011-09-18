<?php

namespace Msi\GalleryBundle\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Msi\GalleryBundle\Entity\Gallery;
use Symfony\Component\HttpFoundation\Response;


class GalleryController extends Controller
{
    
    public function indexAction()
    {
        $em = $this->get('doctrine')->getEntityManager();

        $entity = new Gallery();
        $entity->setName('Nature');
        $em->persist($entity);
        $em->flush();

        return $this->render('MsiGalleryBundle:Gallery:admin/index.html.twig');
    }
}
