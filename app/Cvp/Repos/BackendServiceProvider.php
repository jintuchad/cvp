<?php namespace Cvp\Repos;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {

	public function register()
	{
		// City
		$this->app->bind(
			'Cvp\Repos\City\CityRepository',
			'Cvp\Repos\City\DbCityRepository'
		);

		// Deal
		$this->app->bind(
			'Cvp\Repos\Deal\DealRepository',
			'Cvp\Repos\Deal\DbDealRepository'
		);

		// Dealcategory
		$this->app->bind(
			'Cvp\Repos\Dealcategory\DealcategoryRepository',
			'Cvp\Repos\Dealcategory\DbDealcategoryRepository'
		);

		// Dealoption
		$this->app->bind(
			'Cvp\Repos\Dealoption\DealoptionRepository',
			'Cvp\Repos\Dealoption\DbDealoptionRepository'
		);

		// Dealpic
		$this->app->bind(
			'Cvp\Repos\Dealpic\DealpicRepository',
			'Cvp\Repos\Dealpic\DbDealpicRepository'
		);

		// Dealtab
		$this->app->bind(
			'Cvp\Repos\Dealtab\DealtabRepository',
			'Cvp\Repos\Dealtab\DbDealtabRepository'
		);

		// Orderdealoption
		$this->app->bind(
			'Cvp\Repos\Orderdealoption\OrderdealoptionRepository',
			'Cvp\Repos\Orderdealoption\DbOrderdealoptionRepository'
		);

		// Orderitem
		$this->app->bind(
			'Cvp\Repos\Orderitem\OrderitemRepository',
			'Cvp\Repos\Orderitem\DbOrderitemRepository'
		);

		// Promotion
		$this->app->bind(
			'Cvp\Repos\Promotion\PromotionRepository',
			'Cvp\Repos\Promotion\DbPromotionRepository'
		);

		// Role
		$this->app->bind(
			'Cvp\Repos\Role\RoleRepository',
			'Cvp\Repos\Role\DbRoleRepository'
		);

		// User
		$this->app->bind(
			'Cvp\Repos\User\UserRepository',
			'Cvp\Repos\User\DbUserRepository'
		);
	}
}