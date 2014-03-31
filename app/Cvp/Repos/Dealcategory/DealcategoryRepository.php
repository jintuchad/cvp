<?php namespace Cvp\Repos\Dealcategory;

use Cvp\Repos\BaseRepository;

interface DealcategoryRepository extends BaseRepository {
	
	public function findBySlug($slug);

}