<?php namespace Cvp\Services;

use Cvp\Services\BaseService;

use Cvp\Repos\Deal\DealRepository;

class CityService extends BaseService {

	protected $dealRepo;

	/**
	 * Create a new service instance.
	 *
	 * @param DealRepository  $dealRepo
	 *
	 * @return Service
	 */
	
	public function __construct(DealRepository $dealRepo)
	{
		parent::__construct();

		$this->dealRepo = $dealRepo;
	}

}