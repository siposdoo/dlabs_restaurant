<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuids
{
   
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

   /**
    *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

   /**
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}
/**
     * Boot function from Laravel.
     * Get the value indicating whether the IDs are incrementing.
     * Get the auto-incrementing key type.


     */