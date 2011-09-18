<?php

namespace Msi\GalleryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GalleryImageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('file', 'file', array('required' => true))
            ->add('gallery')
        ;
    }

    public function getName()
    {
        return 'msi_gallerybundle_galleryimagetype';
    }
}
