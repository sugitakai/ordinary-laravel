<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Course;
use App\Models\Reservation;
class user extends Authenticatable
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
        'tel_number',
        'height',
        'body_weight',
        'age',
        'sports_history',
        'possible_option_1',
        'possible_option_2',
        'possible_option_3',
        'Remarks_column1',
        'Remarks_column2',
        'profile',
        'owner'
    ];

    public function image_path()
    {
        return '/images/' . $this->profile; // profileはプロフィール画像のファイル名を表す属性です
    }

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
    public function course()
    {
        return $this->hasMany(Course::class);
    }
    public function courses()
    {
        return $this->belongsTo(Course::class, 'possible_option_1', 'id');
    }

    public function courses2()
    {
        return $this->belongsTo(Course::class, 'possible_option_2', 'id');
    }

    public function courses3()
    {
        return $this->belongsTo(Course::class, 'possible_option_3', 'id');
    }
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
