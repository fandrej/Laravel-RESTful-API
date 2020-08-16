<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dep extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'address', 'point', 'type'];
}
