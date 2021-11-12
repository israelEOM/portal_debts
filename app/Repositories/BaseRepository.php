<?php
namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    /**
     * The relations to eager load.
     *
     * @var
     */
    protected $with = [];


    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $this->model = app($this->model());
    }

    public function resetModel()
    {
        $this->makeModel();
    }

    public function filledModel($model)
    {
        $this->model = empty($model) ? $this->model : $model;
    }


    /**
     * Dynamically set attributes on the model - Custom.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function dynamicAttributes($request)
    {
        foreach ($request as $key => $value) {
            if(array_has($this->model->aliases, $key)){
                $this->model->__set($this->model->aliases[$key], $value);
            }
        }
    }

    /**
     *  Set in prop model
     *
     */
    public function __set($key, $value)
    {
        if(array_has($this->model->aliases, $key)){
            $this->model->__set($this->model->aliases[$key], $value);
        }
    }

    /**
     *  Get prop in model
     *
     */
    public function __get($key)
    {
        if(array_has($this->model->aliases, $key)){
            return $this->model->__get($this->model->aliases[$key]);
        }

        return $this->model->__get($key);
    }

    public function find($id)
    {
        $this->model = $this->query()->find($id);

        return $this;
    }

	public function findById ($id, $columns = ['*'])
    {
        $this->model = $this->query()->find($id, $columns);

        return $this;
    }

    /**
     * Alias of All method
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function get($columns = ['*'])
    {
        return $this->all($columns);
    }

    public function all($columns = ['*'])
    {
        if ($this->model instanceof Builder) {
            $results = $this->model->get($columns);
        } else {
            $results = $this->model->all($columns);
        }
        $this->resetModel();

    	return $results;
    }

    public function getById($id)
    {
        $this->model = $this->query()->find($id);

        return $this;
    }

    public function create(array $data)
    {
        $this->model = $this->query()->create($data);

        return $this;
    }

    public function save()
    {
        return $this->model->save();
    }

    public function delete($id)
    {
        return $this->query()->destroy($id);
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->query()->paginate($perPage, $columns);
    }

    /**
     * Retrieve first data of repository
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function first($columns = ['*'])
    {
        $results = $this->model->first($columns);

        $this->resetModel();

        return $results;
    }


    /**
     * Sets relations for eager loading.
     *
     * @param $relations
     * @return $this
     */
    public function with($relations)
    {
        $this->model = $this->model->with($relations);

        return $this;
    }

    /**
     * Creates a new QueryBuilder instance including eager loads
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function query()
    {
        return $this->model->with($this->with);
    }

    /**
     * Check if entity has relation
     *
     * @param string $relation
     *
     * @return $this
     */
    public function has($relation)
    {
        $this->model = $this->model->has($relation);

        return $this;
    }

 	/**
     * Load relation with closure
     *
     * @param string $relation
     * @param closure $closure
     *
     * @return $this
     */
    public function whereHas($relation, $closure)
    {
        $this->model = $this->model->whereHas($relation, $closure);

        return $this;
    }

    public function notHas($relation, $query = null)
    {
        if($query){
            $this->model = $this->model->whereDoesntHave($relation, $query);
        }
        else{
            $this->model = $this->model->doesntHave($relation);
        }

        return $this;
    }

    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     */
    // public function where($column, $operator = null, $value = null, $boolean = 'and')
    // {
    //     return $this->model->where($column, $operator, $value, $boolean);
    // }

    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhere(array $where, $columns = ['*'])
    {
        $this->applyConditions($where);

        $results = $this->model->get($columns);

        $this->resetModel();

        return $results;
    }

    /**
     * Find data by multiple values in one field
     *
     * @param       $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhereIn($field, array $values, $columns = ['*'])
    {
        $model = $this->model->whereIn($field, $values)->get($columns);

        $this->resetModel();

        return $results;
    }

    public function limit($limit)
    {
        $this->model = $this->model->limit($limit);

        return $this;
    }


    /**
     * Applies the given where conditions to the model.
     *
     * @param array $where
     * @return void
     */
    protected function applyConditions(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }

 	/**
 	 * @param EloquentQueryBuilder|QueryBuilder $query
 	 * @param int                               $take
 	 * @param bool                              $paginate
 	 *
 	 * @return EloquentCollection|Paginator
 	 */
 	protected function doQuery($query = null, $take = 15, $paginate = true)
 	{
 		if (is_null($query)) {
 			$query = $this->query();
 		}

 		if (true == $paginate) {
 			return $query->paginate($take);
 		}

 		if ($take > 0 || false !== $take) {
 			$query->take($take);
 		}

 		return $query->get();
 	}

    public function getAttributes()
    {
        return $this->model->getAttributes();
    }

    public function exist()
    {
        return $this->model->exists;
    }

    public function toArray()
    {
        return $this->model->toArray();
    }

    public function toJson()
    {
        return $this->model;
    }

    public function __destruct()
    {
        // return $this->model->toJson();
    }
}