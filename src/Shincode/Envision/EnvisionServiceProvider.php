<?php namespace Shincode\Envision;

use Illuminate\Support\ServiceProvider;
use Shincode\Envision\Support\Autoloader;
use Illuminate\Support\Facades\Config;

class EnvisionServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('shincode/envision');

		// Enable Envision-specific class generation when the classes are not found
		if (Config::get('envision::settings.generate')) {
			Autoloader::init();
		}

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array(
			
		);
	}

}