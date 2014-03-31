<?php namespace Cvp\Cart;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider {

	public function register()
	{
		// item
		$this->app->bind(
			'Cvp\Cart\Storage\ItemStorage',
			'Cvp\Cart\Storage\ItemSessionStore'
		);

		// cart
		$this->app->bind(
			'Cvp\Cart\Storage\CartStorage',
			'Cvp\Cart\Storage\CartSessionStore'
		);
	}
}