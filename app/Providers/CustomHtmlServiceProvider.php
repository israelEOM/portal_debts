<?php
namespace App\Providers;


use App\Services\Desenv\Html\Form;
use Collective\Html\HtmlServiceProvider;

class CustomHtmlServiceProvider extends HtmlServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->registerCustomForm();
    }

    /**
     * Register the form builder instance.
    */
    protected function registerCustomForm()
    {
        $this->app->singleton('form', function ($app) {
            $form = new Form($app['html'], $app['url'], $app['view'], $app['session.store']->token());

            return $form->setSessionStore($app['session.store']);
        });
    }
}