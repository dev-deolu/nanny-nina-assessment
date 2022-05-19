<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'level',
        'timezone',
        'referal_code'
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
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
        static::creating(function ($user) {
            $user->uuid = (string) Str::uuid(); // Create uuid when a new user is to be created
        });
    }

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    /**
     * Scope a query to only include fileted users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param array filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['name'] ?? null, function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');
        })->when($filters['timezone'] ?? null, function ($query, $timezone) {
            $query->where('timezone', $timezone);
        })->when($filters['level'] ?? null, function ($query, $level) {
            $query->where('level', $level);
        });
    }
}
