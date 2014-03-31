<?php namespace Cvp\Repos;

abstract class DbBaseRepository {

	//public function errors();

	/**
	 * Get all records
	 *
	 * @param  array  $related
	 * @return Model
	 */
	public function all(array $related = null)
	{
		$output = $this->model->all();

		if (!is_null($related))
		{
			$output->load($related);
		}

		return $output;
	}

	/**
	 * Get a record by its primary key.
	 *
	 * @param  int/array  $id
	 * @param  array      $related  optional
	 * @return Model
	 */
	public function get($id, array $related = null)
	{
		$output = (is_array($id)) ?
			$this->model->whereIn('id', $id)->get() :
			$this->model->findOrFail($id);

		if (!is_null($related))
		{
			$output->load($related);
		}

		return $output;
	}

	/**
	 * Get all records that meet specific criteria
	 *
	 * @param  string/array  $column
	 * @param  string/array  $value
	 * @param  array         $related
	 * @return Model
	 */
	public function getWhere($column, $value, array $related = null)
	{
		if (is_array($column))
		{
			if (!is_array($value)) return false;

			$where = '';

			foreach ($column as $key => $col_val)
			{
				$where .= 'where(\''.$col_val.'\',\''.$value[$key].'\')->';
			}

			$where .= 'get()';

			$output = $this->model->$where;
		}
		else
		{
			$output = $this->model->where($column, $value)->get();
		}

		if (!is_null($related))
		{
			$output->load($related);
		}

		return $output;
	}

	/**
	 * Get all recent records within a specific limit
	 *
	 * @param  int    $limit
	 * @param  array  $related
	 * @return Model
	 */
	public function getRecent($limit, array $related = null)
	{
		$output = $this->model->take($limit)->get();

		if (!is_null($related))
		{
			$output->load($related);
		}

		return $output;
	}

	/**
	 * Get paginated records with a specific limit per page
	 *
	 * @param  int    $perPage
	 * @param  array  $related
	 * @return Model
	 */
	public function getPaginated($perPage = 30, array $related = null)
	{
		$output = $this->model->paginate($perPage);

		if (!is_null($related))
		{
			$output->load($related);
		}

		return $output;
	}

	/**
	 * Get paginated records with a specific limit per page that meet specific criteria (optional: sort & direction)
	 *
	 * @param  int           $perPage
	 * @param  string/array  $column
	 * @param  string/array  $value
	 * @param  string        $sortBy
	 * @param  string        $sortDirection
	 * @param  array         $related
	 * @return Model
	 */
	public function getPaginatedWhere($perPage = 30, $column, $value, $sortBy = null, $sortDirection = null, array $related = null)
	{
		if (is_array($column))
		{
			if (!is_array($value)) return false;

			$where = '';

			foreach ($column as $key => $col_val)
			{
				$where .= 'where(\''.$col_val.'\',\''.$value[$key].'\')->';
			}

			$where .= 'paginate('.$perPage.')';

			$output = $this->model->$where;
		}
		else
		{
			$output = $this->model->where($column, $value)->paginate($perPage);
		}

		if (!is_null($related))
		{
			$output->load($related);
		}

		return $output;
	}

	/**
	 * Create a record
	 *
	 * @param  array  $data
	 * @return Model
	 */
	public function create(array $data)
	{
		$model = $this->model;

		foreach ($data as $attribute => $value)
		{
			$model->$attribute = $value;
		}

		$model->save();

		return $model;
	}
	
	/**
	 * Update a record
	 *
	 * @param  int    $id
	 * @param  array  $data
	 * @return model
	 */
	public function update($id, array $data)
	{
		$model = $this->get($id);

		foreach ($data as $attribute => $value)
		{
			$model->$attribute = $value;
		}

		$model->save();

		return $model;
	}

	/**
	 * Delete a record
	 *
	 * @param  int   $id
	 * @param  bool  $force  forces a delete on soft-deleted models
	 * @return Model
	 */
	public function delete($id, $force = false)
	{
		$model = $this->get($id);

		if ($model->isSoftDeleting() && $force)
		{
			$model->forceDelete();
		}
		else
		{
			$model->delete();
		}

		return $model;
	}

	/**
	 * Delete all records that meet specific criteria
	 *
	 * @param  string/array  $column
	 * @param  string/array  $value
	 * @param  bool          $force
	 * @return bool
	 */
	public function deleteWhere($column, $value, $force = false)
	{
		if (is_array($column))
		{
			if (!is_array($value)) return false;

			foreach ($column as $key => $col_val)
			{
				$delete .= 'where(\''.$col_val.'\',\''.$value[$key].'\')->';
			}

			if ($force)
			{
				$delete .= 'forceDelete()';
			}
			else
			{
				$delete .= 'delete()';
			}

			$this->model->$delete;
		}
		else
		{
			if ($force)
			{
				$this->model->where($column, $value)->forceDelete();
			}
			else
			{
				$this->model->where($column, $value)->delete();
			}
		}

		return true;
	}

}