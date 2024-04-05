<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
        dd($validatedData);
        $validatedData['active'] = $validatedData['active'] === 'on' ? true : false;
        $user = User::create($validatedData);
        if (!is_null($user)) {
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
        if (!is_null($user)) {
            $roles = Role::get(['id', 'name']);
            return view('users.create', compact('roles', 'user'));
        }

        return response()->json(['message' => "User Not Found"], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();
        $validatedData['active'] = $validatedData['active'] === 'on' ? true : false;

        if ($validatedData['password'] == null) {
            unset($validatedData['password']);
        }

        if ($user->update($validatedData)) {
            return response()->json(['message' => "User Updated Successfully"], 200);
        }

        return response()->json(['message' => "Some Error Occured While Updating User"], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!is_null($user)) {
            if ($user->delete()) {
                return response()->json(['message' => "User Deleted Successfully"], 200);
            }
        }
        return response()->json(['message' => "User Not Found"], 404);
    }

    public function massDeleteUsers(Request $request)
    {
        $ids = $request->ids;
        $users = User::findOrFail($ids);

        foreach ($users as $user) {
            $user->delete();
        }
        return response()->json(['message' => "Deleted Successfully"]);
    }

    public function updateActiveStatus(Request $request)
    {
        $userId = $request->id;
        $user = User::findOrFail($userId);

        if (!is_null($user)) {
            if ($request->has('activeStatus')) {
                $user->update(['active' => $request->boolean('activeStatus')]);
            }

            return response()->json(['message' => 'Status Updated Successfully'], 200);
        }

    }
}
