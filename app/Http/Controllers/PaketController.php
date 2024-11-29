<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pakets = Paket::latest()->paginate(10);
        return view('home', compact('pakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'fitur' => 'required|string',
        ]);

        Paket::create([
            'nama_paket' => $request->get('nama_paket'),
            'harga' => $request->get('harga'),
            'fitur' => $request->get('fitur'),
        ]);

        return redirect()->route('home')->with('message', 'Paket berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paket = Paket::findOrFail($id);
        return view('paket.show', compact('paket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paket = Paket::findOrFail($id);
        return view('paket.edit', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'fitur' => 'required|string',
        ]);

        $paket = Paket::findOrFail($id);

        $paket->update([
            'nama_paket' => $request->get('nama_paket'),
            'harga' => $request->get('harga'),
            'fitur' => $request->get('fitur'),
        ]);

        return redirect()->route('home')->with('message', 'Paket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        return redirect()->route('home')->with('message', 'Paket berhasil dihapus.');
    }
}
