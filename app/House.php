<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = ['title', 'price', 'description'];

    /**
     * Description of FunctionName
     * @param Type Parameter
     * @return void
     */
    public function city() {
        return $this->belongsTo(City::class);
    }
}
