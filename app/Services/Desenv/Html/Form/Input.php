<?php
namespace App\Services\Desenv\Html\Form;


/**
  * summary
  */
 trait Input
 {
    public function textUp($name, $options, $errors = null, $dataSet = null)
    {
        $this->setName($name);
        $this->setOptions($options);

        $this->init();

        	$this->setLabel();

            $this->baseHtml .= $this->text($name, $this->setValue($dataSet), $this->options);

			$this->setError($errors);
        	$this->setErrorAngular($errors);

        return $this->get();
    }
 }