<?php
namespace App\Services\Desenv\Helpers;


use Symfony\Component\Process\PhpExecutableFinder;

class Command
{
    private $command;
    private $before;
    private $after;
    private $phpBinary;

    public function __construct($command, $before = null, $after = null)
    {
        $this->command = $command;
        $this->before = $before;
        $this->after = $after;
    }

    public static function factory($command, $before = null, $after = null)
    {
        return new self($command, $before, $after);
    }

    public function runInBackground()
    {
        exec($this->composeForRunInBackground());
    }

    public function run()
    {
        if ($this->isWindows()) {
            return "start  {$this->composeForRun()}";
        }

        dd("({$this->composeForRun()})");
    }

    protected function composeForRunInBackground()
    {
        if ($this->isWindows()) {
            return "start /B {$this->composeForRun()}";
        }

        return "({$this->composeForRun()}) > /dev/null 2>&1 &";
    }

    protected function composeForRun()
    {
        $parts = [];
        if (!empty($this->before)) {
            $parts[] = (string) $this->before;
        }
        $parts[] = "{$this->getPhp()} {$this->getArtisan()} {$this->command}";
        if (!empty($this->after)) {
            $parts[] = (string) $this->after;
        }
        return implode(' && ', $parts);
    }

    protected function getPhp()
    {
        $this->phpBinary = (new PhpExecutableFinder)->find();

        return empty($this->phpBinary) ? 'php' : $this->phpBinary;
    }

    protected function getArtisan()
    {
        return defined('ARTISAN_BINARY') ? ARTISAN_BINARY : base_path() . '/artisan';
    }

    public static function isWindows()
    {
        return (strtoupper(substr(php_uname(), 0, 7)) === 'WINDOWS');
    }
}