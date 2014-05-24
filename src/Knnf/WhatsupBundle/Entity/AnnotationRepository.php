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

    /*public function test(){
    	$rsm = new ResultSetMapping();
    	$sql = "SELECT idArticle,COUNT(*) as 'like'
												FROM `annotation` 
												WHERE AnnotationType  = 'like'
												GROUP BY idArticle
												ORDER BY COUNT(*) DESC";
    	//$em = $this->getDoctrine()->getManager();
    	

    	return $this->_em->getConnection()->exec( $sql );
    }*/

	
}
