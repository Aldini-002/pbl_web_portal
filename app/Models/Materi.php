<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['course'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }
}
