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

    public function isAdmin(Attend $atend, StatusLog $log, $id){
        return UserAuth::user()->id === Attend::findOrFail($id);
    }
}
