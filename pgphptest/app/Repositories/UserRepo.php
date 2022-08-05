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

    public static function updateUserComments($id, array $comments) {
    	
    	if (!empty($id)) {

    		$comment_str = '';

    		$user = User::find($id);

    		foreach ($comments as $comment) {
    			//concatenate new comment in comments data
           		$comment_str .=  "\n" .$comment;
    		}

    		$user->comments = $user->comments . $comment_str;
    		
            if ($user->save()) {

            	return true;
            } 
    	}

    	return false;
    }	

}
