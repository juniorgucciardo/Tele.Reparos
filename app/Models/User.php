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
        'user_img'
    ];

    public function service_order(){
        return $this->belongsToMany('App\Models\service_order', 'order_user', 'user_id', 'order_id');
    }

    
    public function attends()
    {
        return $this->belongsToMany('App\Models\Attend', 'attend_user');
    }

    public function myReviews(){
        return $this->hasMany('App\Models\Review', 'author_id', 'id');
    }

    public function reviewsAboutMe(){
        return $this->hasMany('App\Models\Review', 'rated_id', 'id');
    }

    public function statusLogs(){
        return $this->hasMany('App\Models\StatusLog', 'user_id');
    }

    public function Posts(){
        return $this->hasMany('App\Models\Post', 'user_id', 'id');
    }

    public function checklists(){
        return $this->hasMany('App\Models\Checklist', 'user_id', 'id');
    }

    public function itemsConcluted(){
        return $this->hasMany('App\Models\ChecklistItem', 'concluted_by', 'id');
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

    public function getFirstNameAttribute($value)
    {
        $value = ucfirst($this->name);
        return $value;
    }



    public function service()
        {
            return $this->hasManyThrough('App\Models\Service', 'App\Models\service_order', 'users_id', 'id_service' );
        }

        public function adminlte_image()
        {
            return 'https://picsum.photos/300/300';
        }
    
    
        public function adminlte_profile_url()
        {
            return route('user.view', auth()->user()->id);
        }

}
