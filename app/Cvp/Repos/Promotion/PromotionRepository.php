<?php namespace Cvp\Repos\Promotion;

use Cvp\Repos\BaseRepository;

interface PromotionRepository extends BaseRepository {
	
	public function getByDealLink($deal_link);

}