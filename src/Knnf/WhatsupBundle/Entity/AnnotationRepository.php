<?php

namespace Knnf\WhatsupBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
/**
 * AnnotationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnnotationRepository extends EntityRepository
{
	public function getMaxVote($category = null)
    {
    	if($category != null)
    	{
	        $q = $this->_em->createQueryBuilder()
	            ->select('count(annotation.idArticle) as nombre')
	            ->from('KnnfWhatsupBundle:Annotation','annotation')
	            ->where('annotation.category = '.$category->getId())
	            ->where('annotation.AnnotationType = (:AnnotationType)')
	            ->groupBy('annotation.idarticle')
	            ->setParameter('AnnotationType', 'like');
	            ;
	        $query = $q->getQuery();
        }
        else
        {
        	$q = $this->_em->createQueryBuilder()
	            ->select('count(annotation.idArticle) as nombre')
	            ->from('KnnfWhatsupBundle:Annotation','annotation')
	            ->where('annotation.AnnotationType = (:AnnotationType)')
	            ->groupBy('annotation.idArticle')
	            ->setParameter('AnnotationType', 'like');


	        $query = $q->getQuery();

        }
 	

        $query->getResult(); 
 
        return $q;
    }

    public function getDailyComment()
    {
    	$now = date('Y-m-d 00:00:00');
    	$now2 = date('Y-m-d 23:59:59');
    	$q = $this->_em->createQueryBuilder()
	            ->select('count(annotation.idArticle) as nombre')
	            ->from('KnnfWhatsupBundle:Annotation','annotation')
	            ->where('annotation.AnnotationType = (:AnnotationType)')
	            ->andWhere('annotation.dateinsert > (:dateinsert)')
	            ->andWhere('annotation.dateinsert < (:dateinsert2)')
	            ->setParameter('AnnotationType', 'comments')
	            ->setParameter('dateinsert', $now)
	            ->setParameter('dateinsert2', $now2);
	     
	     return $q->getQuery()->getResult();

    }

    public function getDailySignalement()
    {
    	$now = date('Y-m-d 00:00:00');
    	$now2 = date('Y-m-d 23:59:59');
    	$q = $this->_em->createQueryBuilder()
	            ->select('count(annotation.idArticle) as nombre')
	            ->from('KnnfWhatsupBundle:Annotation','annotation')
	            ->where('annotation.AnnotationType = (:AnnotationType)')
	            ->andWhere('annotation.dateinsert > (:dateinsert)')
	            ->andWhere('annotation.dateinsert < (:dateinsert2)')
	            ->setParameter('AnnotationType', 'signalement')
	            ->setParameter('dateinsert', $now)
	            ->setParameter('dateinsert2', $now2);
	     
	     return $q->getQuery()->getResult();

    }
	
}
