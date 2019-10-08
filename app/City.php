<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'code'];

    /**
     * Description of FunctionName
     * @param Type Parameter
     * @return void
     */
    public function houses() {
        return $this->hasMany(House::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
