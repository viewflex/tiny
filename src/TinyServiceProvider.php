<?php

namespace Viewflex\Tiny;


use Illuminate\Support\ServiceProvider;

class TinyServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		/*
    	|--------------------------------------------------------------------------
    	| Load Config and Views
    	|--------------------------------------------------------------------------
    	*/

		$this->mergeConfigFrom(__DIR__.'/../config/tiny.php', 'tiny');
		$this->loadViewsFrom(__DIR__.'/Resources/views', 'tiny');

		/*
        |--------------------------------------------------------------------------
        | Publish Config and Views
        |--------------------------------------------------------------------------
        */

		$this->publishes([
			__DIR__ . '/../config/tiny.php' => config_path('tiny.php'),
            __DIR__ . '/Resources/views' => base_path('resources/views/vendor/tiny')
		], 'tiny');

        /*
        |--------------------------------------------------------------------------
        | Loads Package Migrations on php artisan migrate
        |--------------------------------------------------------------------------
        */

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        /*
        |--------------------------------------------------------------------------
        | Publish Migration
        |--------------------------------------------------------------------------
        */

        $this->publishes([
            __DIR__ . '/Database/Migrations' => base_path('database/migrations')
        ], 'tiny-data');

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		require __DIR__ . '/routes.php';
    }

}
