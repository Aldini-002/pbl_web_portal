<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['course', 'batch', 'materi'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'id_batch');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi');
    }
}
