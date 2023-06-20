<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch_user_history extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['batch', 'user'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['name'] ?? false, function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');
        });

        $query->when($filters['role'] ?? false, function ($query, $role) {
            return $query->where('role', $role);
        });
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'id_batch');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
