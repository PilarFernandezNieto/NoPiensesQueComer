<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{

    use Notifiable, HasApiTokens;
    protected $table = 'users';

    protected $fillable = ['hogar_id', 'name', 'email', 'password'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hogar(): BelongsTo
    {
        return $this->belongsTo(Hogar::class);
    }
}
