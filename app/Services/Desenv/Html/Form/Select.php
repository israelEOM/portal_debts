<?php
namespace App\Services\Desenv\Html\Form;

/**
  summary
 */
trait Select
{
	public function selectUp($name, $dataSet, $options, $errors = null, $default = null)
    {
        $this->setName($name);
        $this->setOptions($options);

        $this->init();

        	$this->setLabel();

            $this->baseHtml .= $this->select($this->name, $this->setDataSet($dataSet), $this->setSelected($default), $this->options);

            $this->setError($errors);
        	$this->setErrorAngular($errors);

        return $this->get();
    }

    private function setDataSet($dataSet)
    {
        $name = isset($this->options['campo']) ? $this->options['campo'] : $this->name;
        $dataSet = (is_array($dataSet) ? $dataSet : array_pluck($dataSet, $name, 'id'));
        asort($dataSet);

        return \Arr::prepend($dataSet, "Selecione", "");
    }

    private function setSelected($default)
    {
        if($default === 0){
            return 0;
        }

        if(empty($default)){
            return isset($this->model->{$this->name}) ? $this->model->{$this->name} : old($this->name);
        }

        if(is_object($default)){
            return $default->pluck('id')->toArray();
        }

        $valor =  $this->checkDataSet($default);

        return ($valor) ? $valor : array_pluck($default, 'id');
    }

    private function withSelecione()
    {
        return !isset($this->options['no_selecione']) ? ['' => $this->changeSelecione()] : [];
    }

    private function changeSelecione()
    {
        return isset($this->options['selecione']) ? $this->options['selecione'] : 'Selecione';
    }
}