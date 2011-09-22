<?php

namespace Msi\GalleryBundle\Entity;

use Doctrine\ORM\EntityRepository;

class GalleryRepository extends EntityRepository
{
    public function findBySlugWithGalleryImages($slug)
    {
        $qb = $this->createQueryBuilder('a')
            ->leftJoin('a.gallery_image', 'g')
            ->where('a.slug = :slug')
            ->setParameter('slug', $slug);

        return $qb->getQuery->getSingleResult();
    }
}