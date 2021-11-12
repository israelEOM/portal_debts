<?php
namespace App\Services\Desenv\Html;


use Collective\Html\FormBuilder;
use App\Services\Desenv\Html\Form\{
    Input,
    Select,
    Password,
    Checkbox
};

class Form extends FormBuilder
{
    use Input, Select, Password, Checkbox;

    protected $baseHtml;
    protected $name;
    protected $formName;
    protected $rotulo;
    protected $options;
    protected $group;

    private function init()
    {
        $this->baseHtml = '<div class="form-group">';
    }

    private function setLabel()
    {
        $this->baseHtml .= '<label class="' . $this->setDefault("class_label", "") . '" id="' . $this->setDefault('id_label', "label") . '">';

        $this->baseHtml .= isset($this->options['rotulo']) ? $this->options['rotulo'] : null;

        $this->baseHtml .= "</label>";

        $this->removeOption("class_label");
        $this->removeOption("id_label");
    }

    private function setDefault($index, $default)
    {
        if(isset($this->options[$index])){
            $valor = $this->options[$index] . $this->setInvisible();

            unset($this->options[$index]);

            return $valor;
        }

        return $default . $this->setInvisible();
    }

    private function setInvisible()
    {
        if(isset($this->options["invisible"])){
            $rules = explode(",", $this->options["invisible"]);

            if($this->getValueAttribute($rules[0]) == $rules[1] || empty($this->getValueAttribute($rules[0]))){
                return " custom-none";
            }
        }
    }

    private function setOptions($options)
    {
        $this->options = $options;

        $this->options['class'] = $this->setDefault('class', "form-control");
    }

    private function setError($errors)
    {
        $error = isset($errors) ? $errors->first($this->name) : null;

        $this->baseHtml .= '<small id="alert_' . self::setDefault("id_alert", $this->name) . '" class="a-error a-default">' . $error . '</small>';
    }

    private function setErrorAngular($errors)
    {
        $ngIf = "{$this->formName}['{$this->name}']";

        $this->baseHtml .= '<small ng-if="' . $ngIf . '.$invalid && ' . $ngIf . '.$dirty" class="a-error">{{ msgError || "Campo inválido."}}</small>';
    }

    private function setName($name)
    {
        $this->name = $name;

        $this->removeOption("name");
    }

    public function setFormName($value)
    {
        $this->formName = $value;
    }

    private function setValue($dataSet)
    {
        $valor =  $this->checkDataSet($dataSet);

        return ($valor) ? $valor : null;
    }

    protected function addOption($key, $value)
    {
        return $this->options[$key] = "{$value}";
    }

    protected function removeOption($key)
    {
        if(isset($this->options[$key])){
            unset($this->options[$key]);
        }
    }

    private function checkDataSet($dataSet)
    {
        // if(isset($dataSet['data_all'])){

        //     // $id = head($dataSet['ids']);
        //     // $idOld = last($dataSet['ids']);
        //     // $campo = $dataSet['campo'];
        //     $data = $dataSet['data_all']->where($id, $dataSet['data']->$idOld)->first();

        //     $dataSet = ($data) ? $data->$campo : null;
        // }

        return $dataSet;
    }

    private function get()
    {
        return $this->baseHtml .= "</div>";
    }
}