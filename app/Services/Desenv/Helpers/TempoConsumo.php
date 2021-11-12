<?php
namespace App\Services\Desenv\Helpers;


class TempoConsumo
{
    private static $inicio;
    private static $tempo;
    private static $memoria;

    public static function start()
    {
        self::$inicio = microtime(true);
    }

    public static function segundos()
    {
        return microtime(true) - self::$inicio;
    }

    public static function memory()
    {
    	self::$memoria = round(((memory_get_peak_usage(true) / 1024) / 1024), 2) . "Mb";

    	return self::$memoria;
    }

    public static function tempo()
    {
    	self::memory();

        $segs = self::segundos();
        $dias = floor($segs / 86400);
        $segs -= $dias * 86400;
        $horas = floor($segs / 3600);
        $segs -= $horas * 3600;
        $minutos = floor($segs / 60);
        $segs -= $minutos * 60;
        $microsegs = ($segs - floor($segs)) * 1000;
        $segs = floor($segs);

        self::$tempo = (empty($dias) ? "" : $dias . "d ") .
            (empty($horas) ? "" : $horas . "h ") .
            (empty($minutos) ? "" : $minutos . "m ") .
            $segs . "s " .
            $microsegs . "ms";

        return self::$tempo;
    }

    public static function end($descricao = null)
    {
    	self::tempo();

    	echo "<pre>";
    		echo "<h4>Descrição: {$descricao}</h4>";
            echo "<h4>Tempo: " . self::$tempo . " </h4>";
    		echo "<h4>Memoria: " . self::$memoria . " </h4>";
    	echo "</pre>";
    }
}