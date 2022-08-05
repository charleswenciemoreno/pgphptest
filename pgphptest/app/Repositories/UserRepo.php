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

    public static function validatePassword($password) {

    	if (!empty($password) && ($password == config('constant.static_password'))) {

    		return true;
    	}

    	return false;
    }	

    public static function updateUserComments($id, $comment) {

    	if (!empty($id)) {

    		$user = User::find($id);

    		//concatenate new comment in comments data
            $user->comments = $user->comments . "\n" .$comment;

            if ($user->save()) {

            	return true;
            } 
    	}

    	return false;
    }	

}
