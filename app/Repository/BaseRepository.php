<?php

namespace App\Repository;

use App\Http\Controllers\Controller;

class BaseRepository extends Controller
{
    public $model;

    public function findByUUID(string $uuid)
    {
        return $this->model->where('uuid', $uuid)->firstOrFail();
    }

    public function createRecord(array $validated_data)
    {
        return $this->model->create($validated_data);
    }

    public function updateRecord(array $validated_data)
    {
        return $this->model->update($validated_data);
    }

    public function updateOrCreateRecord(array $checkRecord, array $validated_data)
    {
        return $this->model->updateOrCreate(
            $checkRecord,
            $validated_data
        );
    }
    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (in_array($method, ['increment', 'decrement'])) {
            return call_user_func_array([$this, $method], $parameters);
        }

        $query = $this->newQuery();

        return call_user_func_array([$query, $method], $parameters);
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $instance = new static;

        return call_user_func_array([$instance, $method], $parameters);
    }
}
