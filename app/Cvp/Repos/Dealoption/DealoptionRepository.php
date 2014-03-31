<?php namespace Cvp\Repos\Dealoption;

use Cvp\Repos\BaseRepository;

interface DealoptionRepository extends BaseRepository {
	
	public function findDealOptions($deal_id);

}