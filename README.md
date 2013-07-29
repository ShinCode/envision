## Envision

Envision is a framework extension for Laravel 4.
[![ProjectStatus](http://stillmaintained.com/ShinCode/envision.png)](http://stillmaintained.com/ShinCode/envision)

The goal of using Envision is speeding up development. It does a few things to help with that:
- Generate and autoload classes that Envision recognises on-the-fly.
#### Example:
Let's say I just created a new migration for the table phones. Let's test what happens when we write the following code in routes.php
        
        new PhonesResource; TODO (text not finished)

- Uses the Ardent package automatically.
- Uses the Presenter package automatically.


### Installation

Envision depends on the Ardent and the Presenter packages in your Laravel framework. So please add those packages as well.
Add `shincode/envision`, Ardent and Presenter to `composer.json`.

    "require": {
      "laravel/framework": "4.0.*",
      "shincode/envision": "dev-master",
      "laravelbook/ardent": "dev-master",
	  "robclancy/presenter": "1.1.*"
    }

Run update with Composer:

    composer update
    
Add the serviceproviders in `app/config/app.php`:

    'Shincode\Envision\EnvisionServiceProvider',
    'Robbo\Presenter\PresenterServiceProvider',

### Contributing To Envision

**All issues and pull requests should be filed on the [shincode/envision](http://github.com/shincode/envision) repository.**

### License

Envision is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
