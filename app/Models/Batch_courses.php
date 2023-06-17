<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch_courses extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['course', 'batch'];

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'id_batch');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }
}
