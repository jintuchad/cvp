<?php namespace Cvp\Repos\Deal;

use Cvp\Repos\BaseRepository;

interface DealRepository extends BaseRepository {
	
	public function getActiveForCity($city, $dealcategory_id = 0);
	public function getByDealLink($deal_link);

}