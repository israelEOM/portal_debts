<?php
namespace App\Services\Desenv\Validator;


use Illuminate\Validation\Validator as BaseValidator;
use App\Services\Desenv\File\FileCustom;

/**
* This class is part of Desenv package
*
* @author Jeferson Nascimento
*/

class Validator extends BaseValidator
{
    public function validateLayoutFile($attribute, $value, $parameters)
    {
        if(empty($this->failed())){
        	$file = new FileCustom($value->path());
        	$row = $file->getFirstRow();

            $this->requireParameterCount(1, $parameters, 'layout');

            if($parameters[1] == 1 && count($row) != 5){
                return false;
            }

            else if($parameters[1] == 2 && count($row) != 5){
               return  false;
            }

            else if($parameters[1] == 3 && count($row) != 6){
               return  false;
            }

            // else if($parameters[1] == 2 && count($row) != 7){
        	   // return  false;
            // }

            return true;
        }

        return false;
    }

    protected function validateUniqueFile($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'unique');

        $table = $parameters[0];

        // The second parameter position holds the name of the column that needs to
        // be verified as unique. If this parameter isn't specified we will just
        // assume that this column to be verified shares the attribute's name.
        $column = isset($parameters[1]) ? $parameters[1] : $attribute;

        list($idColumn, $id) = array(null, null);

        if (isset($parameters[2]))
        {
            list($idColumn, $id) = $this->getUniqueIds($parameters);

            if (strtolower($id) == 'null') $id = null;
        }

        // The presence verifier is responsible for counting rows within this store
        // mechanism which might be a relational database or any other permanent
        // data store like Redis, etc. We will use it to determine uniqueness.
        $verifier = $this->getPresenceVerifier();

        $extra = $this->getUniqueExtra($parameters);

        return $verifier->getCount(

            $table, $column, $value->getClientOriginalName(), $id, $idColumn, $extra

        ) == 0;
    }

    /**
    * Valida o formato do celular junto com o ddd
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    protected function validateCelular($attribute, $value)
    {
        return preg_match('/^\d{2}\d{4,5}\d{4}$/', $value) > 0;
    }

    /**
    * Valida se o CPF é válido
    * @param string $attribute
    * @param string $value
    * @return boolean
    */

    protected function validateCpf($attribute, $value)
    {
        $c = preg_replace('/\D/', '', $value);

        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }
}