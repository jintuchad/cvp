<?php namespace Cvp\Repos\City;

use Cvp\Repos\BaseRepository;

interface CityRepository extends BaseRepository {
	
	public function getSelectionList();
	public function findActive($id);
	public function findActiveBySlug($slug);

}