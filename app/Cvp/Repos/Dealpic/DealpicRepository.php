<?php namespace Cvp\Repos\Dealpic;

use Cvp\Repos\BaseRepository;

interface DealpicRepository extends BaseRepository {
	
	public function findDealFeaturePics($deal_id);

}