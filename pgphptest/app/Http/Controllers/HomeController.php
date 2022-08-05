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
            //concatenate new comment in comments data
            $user->comments = $user->comments . "\n" .$validated['comment'];

            if ($user->save()) {

                return back()->with('success', 'Comment successfully added.');
            }

        } else {

            abort(404);
        }
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
