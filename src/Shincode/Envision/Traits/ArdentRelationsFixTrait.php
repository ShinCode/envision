<?php

namespace Shincode\Envision\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ArdentRelationsFixTrait
{
    public function belongsTo($related, $foreignKey = null, $otherKey = null, $relation = null)
    {
        // If no relation name was given, we will use this debug backtrace to extract
        // the calling method's name and use that as the relationship name as most
        // of the time this will be what we desire to use for the relationships.
        if (is_null($relation)) {
            $backtrace = debug_backtrace(false);

            if ($backtrace[1]['function'] == 'handleRelationalArray') {
                $relation = $backtrace[2]['args'][0];
            } else {
                $relation = $backtrace[1]['function'];
            }
        }

        // If no foreign key was supplied, we can use a backtrace to guess the proper
        // foreign key name by using the name of the relationship function, which
        // when combined with an "_id" should conventionally match the columns.
        if (is_null($foreignKey))
        {
            $foreignKey = snake_case($relation).'_id';
        }

        $instance = new $related;

        // Once we have the foreign key names, we'll just create a new Eloquent query
        // for the related models and returns the relationship instance which will
        // actually be responsible for retrieving and hydrating every relations.
        $query = $instance->newQuery();

        $otherKey = $otherKey ?: $instance->getKeyName();

        return new BelongsTo($query, $this, $foreignKey, $otherKey, $relation);
    }


    /**
     * Eloquent has since updated, but Ardent has not
     */
    public function morphTo($name = null, $type = null, $id = null)
    {
        // If no name is provided, we will use the backtrace to get the function name
        // since that is most likely the name of the polymorphic interface. We can
        // use that to get both the class and foreign key that will be utilized.
        if (is_null($name)) {
            $backtrace = debug_backtrace(false);
            $caller = ($backtrace[1]['function'] == 'handleRelationalArray') ? $backtrace[2] : $backtrace[1];

            if ($backtrace[1]['function'] == 'handleRelationalArray') {
                $name = snake_case($backtrace[2]['args'][0]);
            } else {
                $name = $backtrace[1]['function'];
            }
        }

        list($type, $id) = $this->getMorphs($name, $type, $id);

        // If the type value is null it is probably safe to assume we're eager loading
        // the relationship. When that is the case we will pass in a dummy query as
        // there are multiple types in the morph and we can't use single queries.
        if (is_null($class = $this->$type)) {
            $new_query = $this->newQuery();

            return new MorphTo(
                $new_query, $this, $id, null, $type, $name
            );
        }

        // If we are not eager loading the relationship we will essentially treat this
        // as a belongs-to style relationship since morph-to extends that class and
        // we will pass in the appropriate values so that it behaves as expected.
        else {
            $instance = new $class;

            return new MorphTo(
                $instance->newQuery(), $this, $id, $instance->getKeyName(), $type, $name
            );
        }
    }
}