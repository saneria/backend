<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return $user;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated(); //checks the validation
 
        $user->name = $validated['name']; //set the new name 
 
        $user->save(); 

        return $user;

    }

     /**
     * Update the email of the specified resource in storage.
     */
    public function email(UserRequest $request, string $id)
    { 
        $user = User::findOrFail($id);

        $validated = $request->validated(); //checks the validation
 
        $user->email = $validated['email']; //set the new email
 
        $user->save(); 

        return $user;
    }

     /**
     * Update the password of the specified resource in storage.
     */
    public function password(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated(); //checks the validation
 
        $user->password = Hash::make($validated['password']); //set the new password
 
        $user->save(); 

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = user::findOrFail($id);

        $user->delete();

        return $user;
    }

}