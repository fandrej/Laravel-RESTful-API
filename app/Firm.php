<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'ownership', 'boss'];
}
