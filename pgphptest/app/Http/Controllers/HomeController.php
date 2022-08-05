<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Repositories\UserRepo;
use App\Models\Users\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('index');
    }

    public function getUser($id) {

        $user = UserRepo::getUserById($id);

        if (!$user) {
            abort(403, 'No such user ('.$id.')');
        }

        return view('user', compact('user'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_comment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        //adds password to request array for validation
        Arr::add($request, 'password', '720DF6C2482218518FA20FDC52D4DED7ECC043AB');

        $validated = $request->validate([
            'id' => 'required|int',
            'comment' => 'required',
            'password' => 'required'
        ]);

        if (!UserRepo::validatePassword($validated['password'])) {
            
            return back()->with('error_msg', 'Invalid Password');
        } 

        //get user with validated ID
        $user = User::find($validated['id']);

        if (!empty($user)) {
            //2nd argument expected array parameter
            $insert_comment = UserRepo::updateUserComments($user->id, [$validated['comment']]);

            if ($insert_comment) {

                return back()->with('success', 'Comment successfully added.');
            }

        } else {

            abort(404);
        }
    }

    public function ajaxStore(Request $request) {

        $errors = [];

        if (!UserRepo::validatePassword(strtoupper($request->password))) {
            $errors[] = 'Invalid Password';
        } 

        $user = User::find($request->id);

        if (!empty($user)) {

            if (!empty($request->comment)) {
                //2nd argument expected array parameter
                $insert_comment = UserRepo::updateUserComments($user->id, [$request->comment]);

                //save changes 
                if ($insert_comment) {

                    return response()->json(['success' => 1, 'errors' => $errors]);
                }
                
            } else {
                $errors[] = "Comment is a required field.";
            }
                
        } else {

            $errors[] = "Unauthorized user";
        }

        return response()->json(['success' => 0, 'errors' => $errors]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
