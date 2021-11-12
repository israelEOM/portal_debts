<?php
use Carbon\Carbon;

function get_date()
{
   return Carbon::now()->addMillisecond();
}

function get_date_br()
{
   return Carbon::now()->addMillisecond();
}

function get_format($date)
{
   return Carbon::parse($date)->addMillisecond();
}

function get_dia_mes($date)
{
   Carbon::setLocale('pt_BR');
   $data = Carbon::parse($date);

   return "{$data->day} de " . ucfirst($data->monthName);
}

function str_clean($value)
{
    if(empty($value)){
        return $value;
    }

    $remove = [' ', '-', ')', '(', '/', '.'];
    $value = str_replace($remove, '', $value);

    return preg_replace('/[^A-Za-z0-9\-]/', '', $value);
}

function str_trim($string)
{
   return str_replace("  ",  " ", trim($string));
}

if (! function_exists('date_banco')) {

    function date_banco($value)
    {
        try {
            $value = str_replace(["-"], "/", $value);

            return Carbon::createFromFormat('d/m/Y', $value)->toDateString();

        } catch (Exception $e) {

            return $value;
        }
    }
}

if (! function_exists('str_null')) {

    function str_null($value)
    {
        $value = str_trim($value);

        return empty($value) ? null : $value;
    }
}


if (! function_exists('str_replace_accents')) {

    function str_replace_accents($str)
    {
        $str = htmlentities($str, ENT_COMPAT, "UTF-8");
        $str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/','$1',$str);

        return empty($str) ? null : trim(title_case(html_entity_decode($str)));
    }
}


if (! function_exists('upper')) {

    function upper($str)
    {
        return empty($str) ? $str : strtoupper($str);
    }
}

if (! function_exists('std')) {

    function std(array $dataset)
    {
        return json_decode(json_encode($dataset));
    }
}

if (! function_exists('get_isset')) {

    function get_isset($var)
    {
        return $$var ? $$var: null;
    }
}

if (! function_exists('get_encrypt')) {

    function get_encrypt($value)
    {
        $value = "#Creditc@sh&Desenvolviment0_" . str_clean($value) . "_" . now()->format("Y-m-d");

        return Crypt::encrypt($value);
    }
}

if (! function_exists('get_decrypt')) {

    function get_decrypt($value)
    {
        $decrypted = Crypt::decrypt($value);

        $decrypted = explode("_", $decrypted);

        if(count($decrypted) == 3){
            return $decrypted[1];
        }

        return $value;
    }
}

function date_explode($string)
{
   return explode("T", $string)[0];
}

function msg_cadastro($status = true)
{
	return $status ? "O cadastro foi realizado com sucesso" : "Ocorreu uma falha no processo";
}

function msg_alteracao($status = true)
{
	return $status ? "A alteração foi realizada com sucesso" : "Ocorreu uma falha no processo";
}

function msg_processo($status = true)
{
    return $status ? "O processo foi iníciado com sucesso" : "Ocorreu uma falha no processo";
}

function msg_ativado($status = true)
{
    return $status ? "Solicitação de ativação realizada com sucesso" : "Ocorreu uma falha no processo";
}

function msg_disativado($status = true)
{
    return $status ? "Solicitação de desativação realizada com sucesso" : "Ocorreu uma falha no processo";
}

function msg_excluido($status = true)
{
    return $status ? "Solicitação de exclusão realizada com sucesso" : "Ocorreu uma falha no processo";
}

function msg_mail($status = true)
{
    return $status ? "E-mail enviado com sucesso" : "Ocorreu uma falha no envio de e-mail";
}

function msg_sms($status = true)
{
    return $status ? "SMS enviado com sucesso" : "Ocorreu uma falha no envio de SMS";
}