<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['category'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['title'] ?? false, function ($query, $title) {
            $query->where('title', 'like', '%' . $title . '%');
        });

        $query->when($filters['id_category'] ?? false, function ($query, $id_category) {
            return $query->where('id_category', $id_category);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_course');
    }

    public function batch_course()
    {
        return $this->hasMany(Batch_courses::class, 'id_course');
    }

    public function task()
    {
        return $this->hasMany(Task::class, 'id_course');
    }
}
