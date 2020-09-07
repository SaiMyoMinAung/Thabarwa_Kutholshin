<?php

namespace App\Traits;

/**
 * UUID trait
 */
trait HasUUID
{
    /**
     * Bootable trait for uuid
     *
     * @return void
     */
    protected static function bootHasUUID()
    {
        static::creating(function ($model) {
            do {
                $uuid = uniqid("a");
            } while (static::where('uuid', $uuid)->first());
            $model->uuid = $uuid;
        });

        static::saving(function ($model) {
            // Preventing from creating new UUID for existing records
            $original_uuid = $model->getOriginal('uuid');
    
            if ($original_uuid !== $model->uuid) {
                $model->uuid = $original_uuid;
            }
        });
    }
    /**
     * Route model binding
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
