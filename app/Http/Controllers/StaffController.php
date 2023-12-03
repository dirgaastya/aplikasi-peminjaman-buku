<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = User::where('role_id',2)->get();
        return Inertia::render('Admin/Staff/index', [
            'staffs' => $staffs,
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
        $staffs = User::where('role_id',2)->get();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => 'required',
            'role_id' => 'required',
        ]);

        $id = IdGenerator::generate(['table' => 'users', 'length' => 8, 'prefix' => 'U' . date('y')]);

        $user = new User([
            'id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        $user->save();

        return Inertia::render('Admin/Staff/index', [
            'staffs' => $staffs,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff = User::findOrFail($id);
        $staff->delete();
        return Inertia::render('Admin/Staff/index', [
            'staffs' => User::where('role_id',2)->get()
        ]);
    }
}
