<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'code'];

    /**
     * Description of FunctionName
     * @param Type Parameter
     * @return void
     */
    public function cities() {
        return $this->hasMany(City::class);
    }

    public function houses()
    {
        return $this->hasManyThrough(House::class, City::class);
    }
}
