<?php

namespace Knnf\WhatsupBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends EntityRepository
{

	public function save(array $data){

		$em = $this->getEntityManager();

		$article = new Event();

		if($data['id']){
			$article->setId($data['id']);
			$article->setDateupdate(date());
		} 
		if($data['title']) $article->setTitle($data['title']);
		if($data['description']) $article->setDescription($data['description']);
		if($data['place']) $article->setPlace($data['place']);
		if($data['address']) $article->setAddress($data['address']);
		if($data['orderlink']) $article->setOrderlink($data['orderlink']);
		if($data['datestart']) $article->setDatestart($data['datestart']);
		if($data['dateend']) $article->setDateend($data['dateend']);
		if($data['hourstart']) $article->setHourstart($data['hourstart']);
		if($data['hourend']) $article->setHourend($data['hourend']);
		if($data['activate']) $article->setActivate($data['activate']);
		
		$user = $em->getRepository('KnnfWhatsupBundle:User')->findBy(array('id' => $data['userid']));
		$article->setUser($user);

		$em->persist($article);
        $em->flush();
	}


	public function delete($id){
			if(!$id) die('Missing parameter');

			$em = $this->getEntityManager();
            $article = $em->getRepository('KnnfWhatsupBundle:Event')->find($id);
            $em->remove($article);
            $em->flush();
	}

}
