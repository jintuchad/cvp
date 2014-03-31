<?php namespace Cvp\Cart\Storage;

use Session;

class CartSessionStore implements CartStorage {
	
	public function get()
	{
		return Session::get('cart');
	}

}