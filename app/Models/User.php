<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role',
        'nik',
        'telepon',
        'age',
        'school_level'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['name'] ?? false, function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');
        });

        $query->when($filters['role'] ?? false, function ($query, $role) {
            return $query->where('role', $role);
        });

        $query->when($filters['age'] ?? false, function ($query, $age) {
            return $query->where('age', $age);
        });

        $query->when($filters['school_level'] ?? false, function ($query, $school_level) {
            return $query->where('school_level', $school_level);
        });
    }

    public function batch_user()
    {
        return $this->hasMany(Batch_users::class, 'id_user');
    }

    public function batch_user_history()
    {
        return $this->hasMany(Batch_user_history::class, 'id_user');
    }

    public function ikuti_angkatan()
    {
        return $this->hasMany(Ikuti_angkatan::class, 'id_user');
    }
}
