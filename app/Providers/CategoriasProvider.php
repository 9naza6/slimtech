<?php

namespace App\Providers;

use App\CategoriaCurso;
use View;
use Illuminate\Support\ServiceProvider;

class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {

            $categorias = CategoriaCurso::all();
            $view->with('categorias', $categorias);
        });
    }
}
