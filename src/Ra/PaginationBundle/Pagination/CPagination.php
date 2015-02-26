<?php

namespace Ra\PaginationBundle\Pagination;

class CPagination
{
	protected $postsLength;
	protected $postsPerPage;
	protected $maxlength;

	public function __construct($postsLength, $postsPerPage=9, $maxlength=5)
	{
		$this->postsLength = (int) $postsLength;
		$this->postsPerPage = (int) $postsPerPage;
		$this->maxlength = (int) $maxlength;
	}

	public function getPager($page){
		$arResult = array();
		$arResult['page'] = $page;
		$arResult['postsLength'] = $this->postsLength;
		$arResult['postsPerPage'] = $this->postsPerPage;
		$arResult['maxlength'] = $this->maxlength;
		$arResult['current'] = (int) $page;

		$arResult['postsPagesLength'] = (int) ceil($arResult['postsLength'] / $arResult['postsPerPage']);

		if($arResult['maxlength'] < $arResult['postsPagesLength']){
		    $arResult['length'] = $arResult['maxlength'];
		}else{
		    $arResult['length'] = $arResult['postsPagesLength'];
		}

		$pagerPage = (int) ceil($page/$arResult['length']);

		$arResult['last'] = $pagerPage * $arResult['maxlength'];
		if($arResult['last']  > $arResult['postsPagesLength']){
		    $arResult['last'] = $arResult['postsPagesLength'];
		}
		
		$arResult['first'] = $arResult['last'] - $arResult['length'] + 1;
		return $arResult;
	}
}
