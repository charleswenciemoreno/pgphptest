<?php

namespace App\Repositories;

use App\Models\Users\User;

class UserRepo
{
	
    public static function getUserById($id) {

        if (!empty($id)) {

            $user = User::find($id);

            return $user;
        }

        return false;

    }

}
