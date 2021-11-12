<?php
namespace App\Services\Desenv\Html\Form;


/**
  * summary
  */
trait Checkbox
{
    public function swith($name, $options, $errors = null, $dataSet = null)
    {
        $this->setName($name);
        $this->setOptions($options);

        $this->baseHtml = '<div class="form-group">';

            $this->setLabel();

            $this->baseHtml .= '<div class="switch ' . $this->setDefault("class_switch", "switch-alternative") . '">';

            $this->baseHtml .= $this->checkbox($this->name, null, $this->setIsChecked($dataSet), $this->options);

            $this->baseHtml .= '<label class="cr" for="' . $this->setDefault("id", "id") . '"></label>';
        $this->baseHtml .= '</div>';

        return $this->get();
    }

    public function simpleSwith($name, $options, $errors = null, $dataSet = null)
    {
        $this->setName($name);
        $this->setOptions($options);

        $this->baseHtml = '<div class="form-group">';
            $this->baseHtml .= '<div class="switch ' . $this->setDefault("class_switch", "switch-alternative") . '">';

            $this->baseHtml .= $this->checkbox($this->name, null, $this->setIsChecked($dataSet), $this->options);

            $this->baseHtml .= '<label class="cr" for="' . $this->setDefault("id", "id") . '"></label>';
        $this->baseHtml .= '</div>';

        return $this->get();
    }

    public function setIsChecked($dataSet)
    {
        if(is_array($dataSet)){
            if($dataSet['data_all']->where('id', $dataSet['data']->id)->isNotEmpty()){
                $this->addOption('ng-checked', true);
                return true;
            }
        }

        if($dataSet == 1){
            $this->addOption('ng-checked', true);
            return true;
        }

        $name = $this->name;
        if(isset($this->model->$name) && $this->model->$name == 1){
            $this->addOption('ng-checked', true);
            return true;
        }

        return false;
    }
}