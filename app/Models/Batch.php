<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['title'] ?? false, function ($query, $title) {
            $query->where('title', 'like', '%' . $title . '%');
        });

        $query->when($filters['status'] ?? false, function ($query, $status) {
            return $query->where('status', $status);
        });
    }

    public function batch_course()
    {
        return $this->hasMany(Batch_courses::class, 'id_batch');
    }

    public function batch_user()
    {
        return $this->hasMany(Batch_users::class, 'id_batch');
    }

    public function task()
    {
        return $this->hasMany(Task::class, 'id_batch');
    }

    public function batch_user_history()
    {
        return $this->hasMany(Batch_user_history::class, 'id_batch');
    }

    public function ikuti_angkatan()
    {
        return $this->hasMany(Ikuti_angkatan::class, 'id_batch');
    }
}
