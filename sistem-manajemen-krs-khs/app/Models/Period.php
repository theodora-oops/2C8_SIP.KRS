<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'periods';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'type',
        'semester_id',
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}