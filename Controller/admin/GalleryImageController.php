<?php

namespace Msi\GalleryBundle\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Msi\GalleryBundle\Entity\GalleryImage;
use Msi\GalleryBundle\Form\GalleryImageType;
use Symfony\Component\HttpFoundation\Response;


class GalleryImageController extends Controller
{
    
    public function indexAction()
    {

    }

    public function newAction()
    {
        $entity = new GalleryImage;
        $form = $this->createForm(new GalleryImageType, $entity);
        return $this->render('MsiGalleryBundle:GalleryImage:admin/new.html.twig', array('form' => $form->createView()));
    }

    public function createAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $entity = new GalleryImage;
        $form = $this->createForm(new GalleryImageType, $entity);
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
        return $this->redirect($this->generateUrl('gallery_image_new'));
        } else {
            return $this->render('MsiGalleryBundle:GalleryImage:admin/new.html.twig', array('form' => $form->createView()));
        }
    }    
}
