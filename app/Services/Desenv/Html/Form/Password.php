<?php
namespace App\Services\Desenv\Html\Form;


/**
  * summary
  */
 trait Password
 {
    public function passwordUp($name, $options, $errors = null)
    {

        $this->setName($name);
        $this->setOptions($options);

        $this->init();

            $this->setLabel();

            $this->baseHtml .= $this->password($name, $this->options);

            $this->setError($errors);
            $this->setErrorAngular($errors);

        return $this->get();
    }
}