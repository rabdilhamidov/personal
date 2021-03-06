<?php

namespace Demos\BlogBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * BlogCommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlogCommentRepository extends BaseRepository
{
	public function query_comments($arParams){
		if(!isset($arParams['postID'])){
			return false;
		}
		$arParams['quantity'] = isset($arParams['quantity']) ? $arParams['quantity'] : NULL;
		$arParams['offset'] = isset($arParams['offset']) ? $arParams['offset'] : 0;
		$arParams['locale'] = isset($arParams['locale']) ? $arParams['locale'] : NULL;

		if(isset($arParams['orderBy'])){
			$arParams['orderBy2'] = isset($arParams['orderBy2']) ? $arParams['orderBy2'] : 'created_date';
			$arParams['orderRule2'] = isset($arParams['orderRule2']) ? $arParams['orderRule2'] : 'DESC';
		}else{
			$arParams['orderBy'] = 'created_date';
		}

		$arParams['orderRule'] = isset($arParams['orderRule']) ? $arParams['orderRule'] : 'DESC';

		$qb = $this->createQueryBuilder('p');
		$q_select = $qb ->select('p');
		$q_select	-> where($qb->expr()->eq('p.post', $arParams['postID']))
					-> orderBy('p.'.$arParams['orderBy'], $arParams['orderRule'])
					-> setMaxResults($arParams['quantity'])
					-> setFirstResult($arParams['offset'])
		;

		$q_select -> where($qb->expr()->in('p.post', $arParams['postID']));
		if($arParams['orderBy'] != 'created_date'){
			$q_select -> addOrderBy('p.'.$arParams['orderBy2'], $arParams['orderRule2']);
		}

		$query = $qb -> getQuery();

		// echo '$qb='.$qb;

		$result = $query->getResult();

		return $result;
	}
}
