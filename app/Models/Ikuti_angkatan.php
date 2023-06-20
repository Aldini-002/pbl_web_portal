<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikuti_angkatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['batch', 'user'];

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['status'] ?? false, function ($query, $status) {
            return $query->where('status', $status);
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
