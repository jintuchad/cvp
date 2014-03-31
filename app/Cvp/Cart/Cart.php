<?php namespace Cvp\Cart;

use Cvp\Cart\Storage\CartStorage;
use Cvp\Cart\Storage\ItemStorage;

class Cart {
	
	/**
	 * Create a new cart instance.
	 *
	 * @param CartStorage  $cartStore
	 * @param ItemStorage  $itemStore
	 *
	 * @return Cart
	 */
	public function __construct(CartStorage $cartStore, ItemStorage $itemStore)
	{
		$this->cartStore = $cartStore;
		$this->itemStore = $itemStore;
	}

	/**
	 * Adds an item to the cart
	 *
	 * @param int     $input['item_id']
	 * @param int     $input['price']
	 * @param int     $input['qty']
	 * @param string  $input['url']
	 * @param int     $input['taxable']
	 * @param int     $input['req_shipping']
	 *
	 * @return int
	 */
	public function addItem($input = array())
	{
		if (!$this->cartStore->exists())
		{
			// i left off here

			$this->cartStore->initialize();
		}

		if (!array_key_exists($input['item_id'], $this->itemStore->get()))
		{
			return $this->itemStore->add($input['item_id'], $input);
		}
		else
		{
			return $this->itemStore->update($input['item_id'], $input);
		}

	}

}