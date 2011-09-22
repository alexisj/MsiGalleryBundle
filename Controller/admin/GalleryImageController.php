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
    $images = $this->get('doctrine')->getRepository('MsiGalleryBundle:GalleryImage')->findAll();
    return $this->render('MsiGalleryBundle:GalleryImage:admin/index.html.twig', array('images' => $images));
  }

  public function newAction()
  {
    $form = $this->createForm(new GalleryImageType, new GalleryImage);
    return $this->render('MsiGalleryBundle:GalleryImage:admin/new.html.twig', array('form' => $form->createView()));
  }

  public function createAction(Request $request)
  {
    $em = $this->get('doctrine')->getEntityManager();
    $entity = new GalleryImage;
    $form = $this->createForm(new GalleryImageType, $entity);
    $form->bindRequest($request);

    if ($form->isValid()) {
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_gallery_image'));
    }

    return $this->render('MsiGalleryBundle:GalleryImage:admin/new.html.twig', array('form' => $form->createView()));
  }

  public function editAction($id)
  {
    $entity = $this->get('doctrine')->getRepository('MsiGalleryBundle:GalleryImage')->find($id);
    $form = $this->createForm(new GalleryImageType, $entity);
    return $this->render('MsiGalleryBundle:GalleryImage:admin/edit.html.twig', array('form' => $form->createView()));
  }

  public function updateAction(Request $request, $id)
  {
    $em = $this->get('doctrine')->getEntityManager();
    $entity = $this->get('doctrine')->getRepository('MsiGalleryBundle:GalleryImage')->find($id);
    $form = $this->createForm(new GalleryImageType, $entity);
    $form->bindRequest($request);

    if ($form->isValid()) {
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_gallery_image'));
    }

    return $this->render('MsiGalleryBundle:GalleryImage:admin/edit.html.twig', array('form' => $form->createView()));
  }

  public function deleteAction()
  {
    $em = $this->get('doctrine')->getEntityManager();
    $entity = $this->get('doctrine')->getRepository('MsiGalleryBundle:GalleryImage')->find($id);
    $em->remove($entity);
    $em->flush();
    return $this->redirect($this->generateUrl('admin_gallery_image'));
  }
}
