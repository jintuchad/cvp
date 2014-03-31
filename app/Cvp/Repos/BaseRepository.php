<?php namespace Cvp\Repos;

interface BaseRepository {
	
	public function all(array $related = null);
	public function get($id, array $related = null);
	public function getWhere($column, $value, array $related = null);
	public function getRecent($limit, array $related = null);
	public function getPaginated($perPage, array $related = null);
	public function getPaginatedWhere($perPage = 30, $column, $value, $sortBy = null, $sortDirection = null, array $related = null);
	public function create(array $data);
	public function update($id, array $data);
	public function delete($id, $force = false);
	public function deleteWhere($column, $value, $force = false);

}