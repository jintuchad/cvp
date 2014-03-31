<?php namespace Cvp\Cart\Storage;

interface ItemStorage {
	
	public function get();
	public function add($key, $data);
	public function update($key, $data);

}