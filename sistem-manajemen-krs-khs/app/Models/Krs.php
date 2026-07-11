<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';

    protected $fillable = [
        'mahasiswa_id',
        'matkul_id',
        'semester_id',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }
}