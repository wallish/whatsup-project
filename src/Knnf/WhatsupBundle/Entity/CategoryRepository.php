<?php

namespace Knnf\WhatsupBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{


	public function save(array $data){
		$em = $this->getEntityManager();

		$user = new Category();

		if($data['id']){
			$user->setId($data['id']);
			$user->setDateupdate(date());
		} 
		if($data['name']) $user->setName($data['name']);
		if($data['slug']) $user->setSlug($data['slug']);
		if($data['activate']) $user->setActivate($data['activate']);

		$em->persist($user);
        $em->flush();
	}

	public function delete($id){
		if(!$id) die('Missing parameter');

		$em = $this->getEntityManager();
        $article = $em->getRepository('KnnfWhatsupBundle:Category')->find($id);
        $em->remove($article);
        $em->flush();
	}

	public function fetchPairs(){
		$em = $this->getEntityManager();
		$categories = $em->getRepository('KnnfWhatsupBundle:Category')->findAll();

		foreach ($categories as $category) {
			$data[$category->getId()] = $category->getName();
		}

		return $data;
	}

    public function getSubcategory()
    {
    	$q = $this->_em->createQueryBuilder()
	            ->select('category')
	            ->from('KnnfWhatsupBundle:Category','category')
	            ->where('category.category > 0');
	     
	     return $q->getQuery()->getResult();

    }

   public function getCategory()
    {
    	$q = $this->_em->createQueryBuilder()
	            ->select('category')
	            ->from('KnnfWhatsupBundle:Category','category')
	            ->where('category.category IS NULL')
	            ->andWhere('category.activate = 1');
	     
	     return $q->getQuery()->getResult();

    }
}
