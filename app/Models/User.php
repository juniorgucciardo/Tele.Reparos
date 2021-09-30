<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use hasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function service_order(){
        return $this->belongsToMany('App\Models\service_order', 'service_order_user', 'user_id', 'service_order_id');
    }

    
    public function attends()
    {
        return $this->belongsToMany('App\Models\Attend', 'attend_user');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function adminlte_profile_url()
    {
        return 'admin/perfil/';
    }

    public function service(): HasManyThrough
        {
            return $this->hasManyThrough('App\Models\Service', 'App\Models\service_order', 'users_id', 'id_service' );
        }

}
