<?php namespace Shincode\Envision\Support;

use Shincode\Envision\Support\Singleton;

/**
 * @method static mixed find(int $id) Find one model by id
 * @method static mixed search(string $field, string $search) Specific search
 * @method static mixed filter(string $field, string $symbol, string $search, int $limit = null) Filter
 * @method static mixed all(int $limit = null) Get all the results
 * @method static mixed insert(array $args) Insert one entry
 * @method static mixed update(int $id, array $args) Update one entry
 * @method static void delete(int $id) Delete one entry
 *
 * Class Resource
 * @package Shincode\Envision\Support
 */
abstract class Resource extends Singleton {

    /*
    | Store the model name in a variable
    */
    protected $model;
    
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
    | Find one model by id
    */
    public function find_($id) {
        $model = $this->model;
        return $model::find($id);
    }


    /*
    | Specific search
    */
    public function search_($field, $search) {
        $model = $this->model;

        $result = $model::where($field, '=', $search)->orderBy('id', 'desc')->first();
        return $result;
    }

    /*
    | Filter
    */
    public function filter_($field, $symbol, $search, $limit = null) {
        $limit = $limit ? $limit : null;

        $model = $this->model;
        return $limit ? $model::where($field, $symbol, $search)->take($limit)->orderBy('id', 'desc')->get() : $model::where($field, '=', $search)->get();
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
        $model = $this->model;

        $modelobj = $model::find($id);

        return $this->standardsave($modelobj, $args);
    }


    /*
    | Standard saving method
    */
    protected function standardsave($modelobj, $args) {
        foreach($args as $attribute => $arg) {
            $modelobj->{$attribute} = $arg;
        }

        $modelobj->save();

        return $modelobj;
    }

    /*
    | Delete one entry
    */
    public function delete_($id) {
        $model = $this->model;

        $modelobj = $model::find($id);

        $modelobj->delete();
    }

}
