<?php

namespace App\Http\Controllers;

use App\Models\Dafbuk;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Dafbuk::all();
        return response()->json($books);
    }

    public function index2()
    {
        return view('index');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun' => 'required',
            'penerbit' => 'nullable',
       ]);

       $dafbuk = Dafbuk::create($request->all());
       return response()->json($dafbuk, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Dafbuk::findOrFail($id);
    }

    /**.
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'judul' => 'required',
        'penulis' => 'required',
        'tahun' => 'required',
        'penerbit' => 'nullable',
   ]);
   $dafbuk = Dafbuk::findOrFail($id);
   $dafbuk->update($request->all());
   return response()->json($dafbuk);

}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dafbuk = Dafbuk::findOrFail($id);
        $dafbuk->delete();
        return response()->json(null, 204);
    }
}
