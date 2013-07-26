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
    }

    public function controller($class) {

        $path = app_path().DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR;
        $namespace = null;
        $this->check($path, $namespace, $class, ucfirst(__FUNCTION__));

    }

    public function resource($class) {
        
        $path = app_path().DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.str_plural(strtolower(__FUNCTION__)).DIRECTORY_SEPARATOR;
        $namespace = str_plural(ucfirst(__FUNCTION__));
        $this->check($path, $namespace, $class, ucfirst(__FUNCTION__));

    }

    // Check if anything could be executed
    protected function check($path, $namespace, $class, $parent) {
        // Continue if classname check passes
        if (substr($class, -strlen($parent)) == $parent) {

            // Create vars
            $filename = $class.'.php';

            // Create the class if needed
            if (static::$autoGenerate) {
                $this->create($path, $class, $filename, $parent, $namespace);
            } else {
                // WIll not generate, but at least check if the file exists. If not, return.
                if (!File::exists($path.$filename))
                    return;
            }

            // Load the class
            $this->load($path, $class, $namespace);
            
            
        }

    }

    // Create the necessary files
    protected function create($path, $class, $filename, $parent, $namespace) {
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
            $filenamespace = ($namespace) ? 'namespace '.$namespace.';' : '';

            $originaltags = array('{{ parentnamespace }}', '{{ filenamespace }}', '{{ class }}', '{{ parent }}');
            $replacewith = array(__NAMESPACE__, $filenamespace, $class, $parent);

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