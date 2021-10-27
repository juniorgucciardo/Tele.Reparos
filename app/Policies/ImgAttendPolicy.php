<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StatusLog;
use App\Models\Attend;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;


class ImgAttendPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function isAdmin($id){
        return Auth::user()->id === StatusLog::findOrFail($id)->select('user_id')->get();
    }
}
