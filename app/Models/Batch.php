<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function batch_courses()
    {
        return $this->hasMany(Batch_courses::class, 'id_batch');
    }
}
