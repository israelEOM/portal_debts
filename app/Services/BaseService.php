<?php
namespace App\Services;


abstract class BaseService
{
    abstract public function store(array $dataSet, $validate = false);

    abstract public function update($id, array $dataSet);

   	public static function make()
	{
		$class = get_called_class();
		return new $class();
	}
}