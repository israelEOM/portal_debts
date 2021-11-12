<?php
namespace App\Services\Ws\Traits;


use Exception;
use Arr;
use Carbon\Carbon;
use ReflectionClass;

trait Devedor
{
    public function devedor($nectar)
    {
        if(!$this->validadeDebt($nectar->Resultado->Resultado))
            return false;

        $this->response->telefone = null;
        $this->response->email = null;

        $this->telefone($nectar->Telefones);

        $this->email($nectar->Emails);
    }

    private function telefone($telefones)
    {
        if(empty($telefones))
            return false;

        $telefones = is_array($telefones) ? $telefones : [$telefones];

        $this->response->telefone = array_shift($telefones);
    }

    private function email($emails)
    {
        if(empty($emails))
            return false;

        $emails = is_array($emails->Emails) ? $emails->Emails : [$emails->Emails];

        $this->response->email = trim(array_shift($emails)->EnderecoEmail);
    }
}