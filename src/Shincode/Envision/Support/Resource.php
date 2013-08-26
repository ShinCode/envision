<?php namespace Shincode\Envision\Support;

abstract class Resource {

    /*
    | Store the model name in a variable
    */
    protected $model;
    
    const METHODSYMBOL = '_';

    /*
    | Extract the model name from the full classname
    */
    final public function __construct() {
        $p = $this->namespaceremoval(get_parent_class($this));
        $c = $this->namespaceremoval(get_called_class());
        $this->model = ucfirst(substr($c, 0, -strlen($p)));
    }

    private function namespaceremoval($fullname_with_namespace) {
        return substr($fullname_with_namespace, strrpos($fullname_with_namespace, '\\')+1);
    }


    /*
    | Find one model
    */
    public function find_($id) {
        $model = $this->model;
        return $model::find($id);
    }


    /*
    | Get all the results
    */
    public function all_($limit = null) {
        $limit = $limit ? $limit : null;

        $model = $this->model;
        return $limit ? $model::take($limit)->orderBy('id', 'desc')->get() : $model::all();
    }

    /*
    | Insert one entry
    */
    public function insert_(Array $args) {
        $model = $this->model;

        return $this->standardsave(new $model, $args);
    }

    /*
    | Update one entry
    */
    public function update_($id, Array $args) {
        $model = $this->find($id);

        return $this->standardsave($model, $args);
    }


    /*
    | Standard saving method
    */
    protected function standardsave($model, $args) {
        foreach($args as $attribute => $arg) {
            $model->{$attribute} = $arg;
        }

        return $model->save();
    }

    /*
    | Delete one entry
    */
    public function delete_($id) {
        $model = $this->find($id);

        $model->delete();
    }

    /*
    | Keep a singleton instance
    */
    final public static function getInstance() {
        static $instances = array();

        $calledClass = get_called_class();

        if (!isset($instances[$calledClass])) {
            $instances[$calledClass] = new $calledClass();
        }

        return $instances[$calledClass];
    }

    /*
    | Handle dynamic, static calls.
     */
    public static function __callStatic($method, $args) {

        $instance = static::getInstance();
        $method .= self::METHODSYMBOL;

        switch (count($args)) {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            case 2:
                return $instance->$method($args[0], $args[1]);

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);

            default:
                return call_user_func_array(array($instance, $method), $args);
        }
    }

}