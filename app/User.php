<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // $table->string('username')->unique();
    // $table->string('fullname');
    // $table->string('hp');
    // $table->string('foto');
    // $table->string('level');
    // $table->string('isActive');
    protected $fillable = [
        'nip','username', 'fullname','hp', 'foto', 'level', 'isActive', 'email', 'password', 'jk'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rombel() {
        $this->hasOne('App\Rombel', 'id_guru', 'nip');
    }
}
