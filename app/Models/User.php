<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Iluminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array{
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The topics that belong to the user.
     *
     * @return HasMany<Topic>
     */

    public function topics(): HasMany{
        return $this->hasMany(Topic::class);
    }

    /**
     * The resources that belong to the user.
     *
     * @return HasMany<Resource>
     */

    public function resources(): HasMany{
        return $this->hasMany(Resource::class);
    }

    /**
     * The lessons that belong to the user.
     *
     * @return HasMany<Lesson>
     */

    public function lessons(): HasMany{
        return $this->hasMany(Lesson::class);
    }

}
