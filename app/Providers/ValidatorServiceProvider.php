<?php
namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\Desenv\Validator\Validator as DesenvValidator;
use Validator as BaseValidator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        self::registerCustomValidator();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function registerCustomValidator()
    {
        $me = $this;
        BaseValidator::resolver(function($translator, $data, $rules, $messages) use($me)
        {
            $messages += $me->getMessages();

            return new DesenvValidator($translator, $data, $rules, $messages);
        });
    }

    protected function getMessages()
    {
        return [
            'cpf'              => 'O campo :attribute não é um CPF válido',
            'multianexo'       => 'O campo :attribute não é válido',
        ];
    }
}