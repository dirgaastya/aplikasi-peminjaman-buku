<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Buku;
use Inertia\Inertia;
use Inertia\Response;

use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Buku::all();
        return Inertia::render('Admin/Book/index', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rak = Rak::all();
        return Inertia::render('Admin/Book/form',[
            'rak' => $rak
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'bukus', 'length' => 8, 'prefix' => 'B' . date('y')]);
        $buku = new Buku([
            'id' => $id,
            'title' => $request->input('title'),
            'qty' => $request->input('qty'),
            'year' => $request->input('tahun'),
            'penerbit' => $request->input('penerbit'),
            'pengarang' => $request->input('pengarang'),
            'rak_id' => $request->input('rak'),
        ]);
        $buku->save();
        return response()->json('Product created!');
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
        $rak = Rak::all();
        $buku = Buku::findOrFail($id);
        return Inertia::render('Admin/Book/form',['id' => $id, 'buku' => $buku,'rak' => $rak]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->update($request->all());
        return response()->json('Buku updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return response()->json('Buku deleted!');
    }
}
