## Envision

Envision is a framework extension for Laravel 4.
[![ProjectStatus](http://stillmaintained.com/ShinCode/envision.png)](http://stillmaintained.com/ShinCode/envision)

The goal of using Envision is speeding up development. It does a few things to help with that:
- Generate and autoload classes that Envision recognises on-the-fly.
- Uses the Ardent package automatically.
- Uses the Presenter package automatically.

### Example
Here's a mini tutorial. Let's create a table called phones for our database. Run the follow artisan command:

	php artisan migrate:make create_users_table
	
Let's edit that file (keeping it simple)

	public function up() {
		Schema::create('phones', function(Illuminate\Database\Schema\Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});
	}
    	
Run the migration

	php artisan migrate
	
Now add this to app/routes.php
        
	Route::controller('phone', 'PhoneController');

Notice how you haven't created any files yet, but instantly refer to the PhoneController. Run the application.You'll see that a PhoneController.php has appeared in your app/controllers structure.

Let's open this controller and add a function

	public function getIndex() {
		PhoneResource::insert(array('name' => 'Sunkia'));
		PhoneResource::insert(array('name' => 'Nosy'));
		PhoneResource::insert(array('name' => 'Namnung'));
	}

See where it's going? You never actually made the classes, you're just writing what you want to do. First we created generic routing method. Now we populate the database a little bit so we have something to work with.
Since we created a controller route to 'phone', all we have to do now is to go /phone and the function will be executed.
Of course we normally use a seed for this, but this way you understand how easy it is to create new entries.

The next step is to display them. Let's see how that works. Change the getIndex to something else:

	public function getIndex() {
	    $phones = PhoneResource::all();
	    View::make('phone')->with('phones', $phones);
	}
	
Let's make a view file as well and save it as view/phone.blade.php UNDER  CONSTRUCTION


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
