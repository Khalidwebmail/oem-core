<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['dept_id', 'name', 'slug', 'code', 'credit_hour'];
}
