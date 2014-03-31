<?php

use Cvp\Cart\Cart;

class CartController extends \BaseController {

	protected $cart;

	/**
	 * Create a new controller instance.
	 *
	 * @param Cart  $cart
	 *
	 * @return Controller
	 */
	public function __construct(Cart $cart)
	{
		$this->cart = $cart;
	}

	/**
	 * Display the cart
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
	
	/**
	 * Add an item to the cart
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = array(
			'item_id' => Input::get('dealoption_id'),
			'price' => (int) Input::get('price'),
			'qty' => 1,
			'uri' => Input::get('uri'),
			'taxable' => 0,  // TODO
			'req_shipping' => (int) Input::get('req_shipping'),
		);

		$this->cart->addItem($data);

		// if (!$this->userService->create(Input::all()))
		// {
		// 	return Redirect::back()->withErrors($this->userService->errors())->withInput();
		// }

		// Alert::success('User successfully created!')->flash();

		return Redirect::route('cart.index');
	}

	/**
	 * Remove an item from the cart
	 *
	 * @param  int  $cart_id
	 * @return Response
	 */
	public function destroy($cart_id)
	{
		// $user_id = Crypt::decrypt($crypt_id);

		// if (!$this->userService->delete($user_id))
		// {
		// 	return Redirect::back()->withErrors($this->userService->errors())->withInput();
		// }

		// Alert::success('User successfully deleted!')->flash();

		// return Redirect::route('dashboard.users.index');
	}

}