<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('media')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get(['id', 'name']);
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['active'] = $validatedData['active'] === 'on' ? true : false;
        $user = User::create($validatedData);
        if(!is_null($user)){
            return response()->json(['message' => "User Created Successfully!"], 200);
        }

        return response()->json(['message' => "Some Error Occured While Creating User!"], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if(!is_null($user)){
            $roles = Role::get(['id', 'name']);
            return view('users.create', compact('roles', 'user'));
        }

        return response()->json(['message' => "User Not Found"], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(!is_null($user)){
            if($user->delete()){
                return response()->json(['message' => "User Deleted Successfully"], 200);
            }
        }
        return response()->json(['message' => "User Not Found"], 404);
    }

    public function massDeleteUsers(Request $request)
    {
        $ids = $request->ids;
        $users = User::findOrfail($ids);

        foreach ($users as $user) {
            $user->delete();
        }
        return response()->json(['message' => "Deleted Successfully"]);
    }
}
