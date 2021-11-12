<?php
namespace App\Services\Desenv\File;


/**
 * summary
 */
class FileCustom
{
	public $handle;
    public $nameFile;
    public $line;
	public $delimiter;

    /**
     * summary
     */
    public function __construct($file)
    {
    	$this->nameFile = $file;

        $this->getDelimiter();
    }

    public function getRandomLines($tipo = null)
    {
        $this->lines = file($this->nameFile);
        if(count($this->lines) > 6 ){
            $totalLinhas = ceil(count($this->lines) / 6);
        }
        else{
            $totalLinhas = ceil(count($this->lines) / 3);
        }

        $qtLinhas = ($totalLinhas > 100) ? 100 : $totalLinhas;
        $linhas = collect();
        unset($this->lines[0]);

        for ($i = 0; $i < $qtLinhas; $i++) {
            $line = $this->lines[array_rand($this->lines)];

            $dataSet = str_getcsv($line, $this->delimiter);

            if($tipo == 2){
                $linhas->push($this->carregaDataRow());
            }
            else{
                $linhas->push($this->carregaDataRowSimple($dataSet));
            }
        }

        return $linhas;
    }

    public function open()
    {
    	$this->handle = fopen($this->nameFile, "r");

    	return $this->handle !== FALSE;
    }

    public function getFirstRow()
    {
        $this->line = file($this->nameFile)[0];

        return str_getcsv($this->line, $this->delimiter);
    }

    public function getQtRow()
    {
        return count(file($this->nameFile)) - 1;
    }

    private function getDelimiter()
    {
        $delimiters = [';' => 0, ',' => 0, "\t" => 0, "|" => 0];

        $line = file($this->nameFile)[0];

        foreach ($delimiters as $delimiter => &$count) {
            $count = count(str_getcsv($line, $delimiter));
        }

        $this->delimiter = array_search(max($delimiters), $delimiters);
    }

    public function __destruct()
    {
        if($this->handle){
            fclose($this->handle);
        }
    }
}