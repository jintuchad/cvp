<?php namespace Cvp\Repos\Dealtab;

use Cvp\Repos\BaseRepository;

interface DealtabRepository extends BaseRepository {
	
	public function findDealTabs($deal_id);

}