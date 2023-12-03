<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Inertia\Inertia;
use Inertia\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = User::where('role_id',3)->get();
        return Inertia::render('Admin/Member/index', [
            'members' => $members,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::skip(1)->take(2)->get();
        return Inertia::render('Admin/User/form',['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $members = User::where('role_id',2)->get();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => 'required',
            'role_id' => 'required',
        ]);

        $id = IdGenerator::generate(['table' => 'users', 'length' => 8, 'prefix' => 'U' . date('y')]);
        $userDetailId = IdGenerator::generate(['table' => 'user_details', 'length' => 8, 'prefix' => 'UD' . date('y')]);

        $user = new User([
            'id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        $userDetail = new UserDetail([
            'id' => $userDetailId,
            'name' => $request->name,
            'gender' => $request->gender,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
            'user_id' => $id,
        ]);

        $user->save();
        $userDetail->save();

        return Inertia::render('Admin/Member/index', [
            'members' => $members,
        ]);
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
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        $member = User::findOrFail($id);
        $member->delete();
        return Inertia::render('Admin/Member/index', [
            'members' => User::where('role_id',3)->get()
        ]);
    }
}
