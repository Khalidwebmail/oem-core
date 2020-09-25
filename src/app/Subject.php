<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['dept_id', 'name', 'slug', 'code', 'credit_hour'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id', "id");
    }
}
