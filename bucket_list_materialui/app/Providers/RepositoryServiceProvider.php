<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Binding models
     * @var array
     */

     private $models=[
        'user',
        'userToken',
     ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach($this->models as $model){
          $this->app->bind(
            "App\Repositories\Interfaces\\{$model}RepositoryInterface",
            "App\Repositories\Interfaces\\{$model}Repository"
          );
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
