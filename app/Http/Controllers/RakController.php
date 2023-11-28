<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raks = Rak::all();
        return Inertia::render('Admin/Rak/index', [
            'raks' => $raks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Rak/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Rak::create($request->all());
        return Inertia::render('Admin/Rak/index', [
            'raks' => Rak::all()
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
        $rak = Rak::findOrFail($id);
        return Inertia::render('Admin/Rak/form',['kode_rak' => $id, 'rak' => $rak,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rak = Rak::findOrFail($id);
        $rak->update($request->all());
        return Inertia::render('Admin/Rak/index', [
            'raks' => Rak::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rak = Rak::findOrFail($id);
        $rak->delete();
        return Inertia::render('Admin/Rak/index', [
            'raks' => Rak::all()
        ]);
    }
}
