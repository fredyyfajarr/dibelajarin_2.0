<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser; // <-- Tambahkan ini
use Filament\Panel; // <-- Tambahkan ini
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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

     public function canAccessPanel(Panel $panel): bool
    {
        // Izinkan akses hanya jika peran user adalah 'admin' atau 'instructor'
        return in_array($this->role, ['admin', 'instructor']);
    }

    // ==========================================================
    // TAMBAHKAN METHOD INI
    // Mendefinisikan bahwa satu User (sebagai Instruktur) memiliki banyak Course.
    // ==========================================================
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Mendefinisikan kursus yang diikuti oleh User (sebagai Siswa).
     */
    public function enrolledCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'user_id', 'course_id')->withTimestamps();
    }

    /**
     * Mendefinisikan pelajaran yang sudah diselesaikan oleh User (sebagai Siswa).
     */
    public function completedLessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'progress', 'user_id', 'lesson_id')->withTimestamps();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
