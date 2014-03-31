<?php namespace Cvp\Cart\Storage;

use Session;

class ItemSessionStore implements CartStorage {
	
	public function get()
	{
		return Session::get('cart');
	}

	/**
	 * Add an item to the store
	 *
	 * @param int     $key
	 * @param int     $data['price']
	 * @param int     $data['qty']
	 * @param string  $data['url']
	 * @param int     $data['taxable']
	 * @param int     $data['req_shipping']
	 *
	 * @return int
	 */
	public function add($key, $data)
	{
		$data = array(
			'price' => $data['price'],
			'qty' => $data['qty'],
			'uri' => $data['uri'],
			'taxable' => $data['taxable'],
			'req_shipping' => $data['req_shipping'],
		);

		Session::put('cart.items.'.$key, $data);

		return $key;
	}

	/**
	 * Update a stored item
	 *
	 * @param int     $key
	 * @param int     $data['price']
	 * @param int     $data['qty']
	 * @param string  $data['url']
	 * @param int     $data['taxable']
	 * @param int     $data['req_shipping']
	 *
	 * @return int
	 */
	public function update($key, $data)
	{
		$item = Session::get('cart.items.'.$key);

		$data = array(
			'price' => (isset($data['price'])) ? $data['price'] : $item['price'],
			'qty' => (isset($data['qty'])) ? $data['qty'] : $item['qty'],
			'uri' => (isset($data['uri'])) ? $data['uri'] : $item['uri'],
			'taxable' => (isset($data['taxable'])) ? $data['taxable'] : $item['taxable'],
			'req_shipping' => (isset($data['req_shipping'])) ? $data['req_shipping'] : $item['req_shipping'],
		);

		Session::forget('cart.items.'.$key);

		Session::put($key, $data);

		return $key;
	}

}