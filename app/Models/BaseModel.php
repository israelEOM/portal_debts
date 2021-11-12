<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model
{
	public function __construct()
	{
		$this->autoApply();
	}

    public function hasGetMutator($key)
	{
		if( method_exists($this, 'get'.studly_case($key).'Attribute')){
			return true;
		}

		return isset($this->aliases[$key]);
	}

	protected function mutateAttribute($key, $value)
	{
		$key = $this->aliases[$key];

		return isset($this->attributes[$key]) ? $this->attributes[$key] : null;
	}

	private function autoApply()
	{
		foreach ($this->aliases as $key => $value) {
			array_push($this->appends, $key);
			array_push($this->hidden, $value);
		}
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
            if(array_has($this->aliases, $key)){
            	$this->__set($key, $value);
        	}
        }
    }

    public function __set($prop, $value)
	{
		if(isset($this->aliases[$prop])){
			$prop = $this->aliases[$prop];
		}

        $this->setAttribute($prop, $value);
	}

    public function __get($key)
	{
		if(isset($this->aliases[$key])){
			$key = $this->aliases[$key];
		}

        return $this->getAttribute($key);
	}
}