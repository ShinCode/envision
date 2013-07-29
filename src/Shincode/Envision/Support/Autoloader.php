<?php namespace Shincode\Envision\Support;

use Illuminate\Support\Facades\File;
use Illuminate\Foundation\AliasLoader;

class Autoloader {

    public static $instance;

    protected static $templatesDir;
    protected static $autoGenerate;


    public static function init($create = false) {
        if (self::$instance == NULL)
            self::$instance = new self($create);

        return self::$instance;
    }

    public function __construct($create = false) {
        static::$templatesDir = __DIR__.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR;
        static::$autoGenerate = $create;
        spl_autoload_register(array($this, 'resource'));
        spl_autoload_register(array($this, 'controller'));
        spl_autoload_register(array($this, 'presenter'));
    }

    public function presenter($class) {

        // Check if the classname is something that should be caught
        $parent = ucfirst(__FUNCTION__);
        if (substr($class, -strlen($parent)) == $parent) {

            $path = app_path().DIRECTORY_SEPARATOR.'presenters'.DIRECTORY_SEPARATOR;
            $namespace = null;
            $parentnamespace = 'Robbo\\Presenter';
            $this->extend($path, $namespace, $parentnamespace, $class, ucfirst($parent));

        }

    }

    public function controller($class) {

        // Check if the classname is something that should be caught
        $parent = ucfirst(__FUNCTION__);
        if (substr($class, -strlen($parent)) == $parent) {

            $path = app_path().DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR;
            $namespace = null;
            $parentnamespace = 'LaravelBook\\Ardent';
            $this->extend($path, $namespace, $parentnamespace, $class, ucfirst($parent));

        }

    }

    public function resource($class) {

        // Check if the classname is something that should be caught
        $parent = ucfirst(__FUNCTION__);
        if (substr($class, -strlen($parent)) == $parent) {
        
            $path = app_path().DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.str_plural(strtolower(__FUNCTION__)).DIRECTORY_SEPARATOR;
            $namespace = str_plural(ucfirst(__FUNCTION__));
            $parentnamespace = __NAMESPACE__;
            $this->extend($path, $namespace, $parentnamespace, $class, ucfirst($parent));

            // Also check for the model
            $path = app_path().DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR;
            $model = ucfirst(substr($class, 0, -strlen( $parent )));
            $namespace = null;
            $parentnamespace = 'LaravelBook\\Ardent';
            $this->extend($path, $namespace, $parentnamespace, $model, 'Ardent', true);

        }

    }

    // Create a file from a template if needed
    protected function extend($path, $namespace, $parentnamespace, $class, $parent) {

        // Create vars
        $filename = $class.'.php';

        // Create the class if needed
        if (static::$autoGenerate) {
            $this->create($path, $class, $filename, $parent, $namespace, $parentnamespace);
        } else {
            // WIll not generate, but at least check if the file exists. If not, return.
            if (!File::exists($path.$filename))
                return;
        }

        // Load the class
        $this->load($path, $class, $namespace);

    }

    // Create the necessary files
    protected function create($path, $class, $filename, $parent, $filenamespace, $parentnamespace) {
        // Check if directory exists
        if (!File::exists($path)) {
            File::makeDirectory($path);
        }

        // Check if file exists
        if (!File::exists($path.$filename)) {

            // Use default template if no template found
            $location = static::$templatesDir.$parent.'.txt';
            $location = File::exists($location) ? $location : static::$templatesDir.'Default.txt';

            $code = File::get($location);
            $filenamespacetext = ($filenamespace) ? 'namespace '.$filenamespace.';' : '';

            $originaltags = array('{{ parentnamespace }}', '{{ filenamespace }}', '{{ class }}', '{{ parent }}');
            $replacewith = array($parentnamespace, $filenamespacetext, $class, $parent);

            $code = str_replace($originaltags, $replacewith, $code);

            File::put($path.$filename, $code);
        }
    }

    protected function load($path, $class, $namespace) {

        require($path.$class.'.php');

        $namespace .= ($namespace) ? '\\' : '';

        // Create Alias
        $loader = AliasLoader::getInstance();
        $loader->alias($class, $namespace.$class);
        if (!class_exists($class))
            $loader->load($class);

    }

}