## Envision

Envision is a framework extension for Laravel 4.

Current version does the following:
- Autoloads Envision specific classses without creating an alias for them.
- Generates Envision specific classes on the fly just by mentioning it (ie: new FoobarResource).
- Provides an empty resource class.


### Installation

Note: this is just boilertext at the moment, this package hasn't been uploaded to Packagist yet.

Install with Composer. Add `shincode/envision` to `composer.json`.

    "require": {
      "laravel/framework": "4.0.*",
      "shincode/envision": "dev-master"
    }

Run update with Composer:

    composer update
    
Add the serviceprovider in `app/config/app.php`:

    'Shincode\Envision\EnvisionServiceProvider'

### Contributing To Envision

**All issues and pull requests should be filed on the [shincode/envision](http://github.com/shincode/envision) repository.**

### License

Envision is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
