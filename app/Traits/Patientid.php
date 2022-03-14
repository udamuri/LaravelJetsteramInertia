<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Carbon\Carbon;

trait Patientid
{

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->patientid =  Carbon::now()->isoFormat('YYMM') . sprintf('%06d', $model->id);
            } catch (\Exception $ex) {
                abort(500, $ex->getMessage());
            }
        });
    }

}
