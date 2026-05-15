<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * العواميد المسموح بحفظها مباشرة
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // تأكد إن الـ role موجودة هنا
    ];

    /**
     * العواميد المخفية
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * تحويل البيانات
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // علاقة المستخدم بالدكتور (لو كان دكتور)
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id');
    }

    // علاقة المريض بالحجوزات
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
