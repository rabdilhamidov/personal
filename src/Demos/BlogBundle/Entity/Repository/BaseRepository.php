<?php

namespace Demos\BlogBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BaseRepository extends EntityRepository
{
	public function query_posts($arParams){
		$arParams['catID'] = isset($arParams['catID']) ? $arParams['catID'] : NULL;
		$arParams['quantity'] = isset($arParams['quantity']) ? $arParams['quantity'] : NULL;
		$arParams['offset'] = isset($arParams['offset']) ? $arParams['offset'] : 0;

		if(isset($arParams['orderBy'])){
			$arParams['orderBy2'] = isset($arParams['orderBy2']) ? $arParams['orderBy2'] : 'updated_date';
			$arParams['orderRule2'] = isset($arParams['orderRule2']) ? $arParams['orderRule2'] : 'DESC';
		}else{
			$arParams['orderBy'] = 'updated_date';
		}
		$arParams['orderRule'] = isset($arParams['orderRule']) ? $arParams['orderRule'] : 'DESC';


		$qb = $this->createQueryBuilder('p');
		$q_select = $qb ->select('p');
		$q_select	-> orderBy('p.'.$arParams['orderBy'], $arParams['orderRule'])
					-> setMaxResults($arParams['quantity'])
					-> setFirstResult($arParams['offset'])
			;

		if(isset($arParams['catID'])){
			$q_select -> where($qb->expr()->in('p.category', $arParams['catID']));
		}
		if($arParams['orderBy'] != 'updated_date'){
			$q_select -> addOrderBy('p.'.$arParams['orderBy2'], $arParams['orderRule2']);
		}

		$query = $qb -> getQuery();

		// echo '$qb='.$qb;

		$result = $query->getResult();
		return $result;
	}

	public function count_posts($arParams=false){
		$qb = $this->createQueryBuilder('p');
		$q_select = $qb ->select('p');
		if(isset($arParams['catID'])){
			$q_select -> where($qb->expr()->in('p.category', $arParams['catID']));
		}
		$qb -> add('select', $qb->expr()->count('p'));
		$query = $qb -> getQuery();
		$result = $query->getSingleScalarResult();
		return $result;
	}

}