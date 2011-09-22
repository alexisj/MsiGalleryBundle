<?php

namespace Msi\GalleryBundle\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Msi\GalleryBundle\Entity\Gallery;
use Msi\GalleryBundle\Form\GalleryType;
use Symfony\Component\HttpFoundation\Response;


class GalleryController extends Controller
{
  public function indexAction()
  {
    $galleries = $this->get('doctrine')->getRepository('MsiGalleryBundle:Gallery')->findAll();
    return $this->render('MsiGalleryBundle:Gallery:admin/index.html.twig', array('galleries' => $galleries));
  }

  public function newAction()
  {
    $this->createForm(new GalleryType, new Gallery);
    return $this->render('MsiGalleryBundle:Gallery:admin/new.html.twig', array('form' => $form->createView()))
  }

  public function createAction(Request $request)
  {
    $em = $this->get('doctrine')->getEntityManager();
    $entity = new Gallery;
    $form = $this->createForm(new GalleryType, $entity);
    $form->bindRequest($request);

    if ($form->isValid()) {
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_gallery'));
    }

    return $this->render('MsiGalleryBundle:Gallery:admin/new.html.twig', array('form' => $form->createView()))
  }

  public function editAction($id)
  {
    $entity = $this->get('doctrine')->getRepository('MsiGalleryBundle:Gallery')->find($id);
    $this->createForm(new GalleryType, $entity);
    return $this->render('MsiGalleryBundle:Gallery:admin/edit.html.twig', array('form' => $form->createView()))
  }

  public function updateAction(Request $request, $id)
  {
    $em = $this->get('doctrine')->getEntityManager();
    $entity = $this->get('doctrine')->getRepository('MsiGalleryBundle:Gallery')->find($id);
    $form = $this->createForm(new GalleryType, $entity);
    $form->bindRequest($request);

    if ($form->isValid()) {
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_gallery'));
    }

    return $this->render('MsiGalleryBundle:Gallery:admin/edit.html.twig', array('form' => $form->createView()))
  }

  public function deleteAction()
  {
    $em = $this->get('doctrine')->getEntityManager();
    $entity = $this->get('doctrine')->getRepository('MsiGalleryBundle:Gallery')->find($id);
    $em->remove($entity);
    $em->flush();
    return $this->redirect($this->generateUrl('admin_gallery'));
  }
}
