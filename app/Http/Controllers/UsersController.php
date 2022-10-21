<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreuserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $data = User::all();
            return response()->json($data);
        } else {
            abort(403, "You are not authorized to access this");
        }
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \App\Http\Requests\StoreuserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreuserRequest $request)
    {
        $role = strtolower($request['role']);

        if ($role == "client") {
            $user = User::create($request->all());
            $user->assignRole('Client');
        } else if ($role == "developer") {
            $user = User::create($request->all());
            $user->assignRole('Developer');
        } else if ($role == "admin") {
            $user = User::create($request->all());
            $user->assignRole('Admin');
        } else {
            return `Error, choose either "Client", "Developer" or "Admin"`;
        }

        return response()->json($user);
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    /**
     * Update an existing user by id
     *
     * @param  \App\Http\Requests\UpdateuserRequest  $request
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        return tap($user)->update($request->all());
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json('Delete User:' . $id, 204);
    }

    public function getDev()
    {
        // if (Auth::user()->hasRole('Admin')) {
        $data = User::where("role", "Developer")->get();
        return response()->json($data);
        // } else {
        //     abort(403, "You are not authorized to access this");
        // }
    }
}