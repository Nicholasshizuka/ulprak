<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Tanggapan;

class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id_pesanan = $request->query('id_pesanan'); // Mendapatkan ID dari URL
        return view('tanggapan.create', compact('id_pesanan'));

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_pesanan' => 'required|exists:pesanans,id_pesanan', // Ensure this matches your column name
            'tgl_tanggapan' => 'required|date',
            'tanggapan' => 'required|string',
            'status' => 'required|string',
        ]);

        Tanggapan::create([
            'id_pesanan' => $request->id_pesanan,
            'tgl_tanggapan' => $request->tgl_tanggapan ?? now(), // Use current date if not provided
            'tanggapan' => $request->tanggapan,
            'user_id' => $request->user_id,
        ]);
        

        Pesanan::where('id_pesanan', $request->id_pesanan)->update(['status' => $request->status]);

        return redirect()->route('pesanan.index')->with('message', 'Tanggapan berhasil disimpan.');
    }


    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Retrieve the Tanggapan by its ID
        $tanggapan = Tanggapan::findOrFail($id);

        // Pass the Tanggapan object to the view
        return view('tanggapan.edit', compact('tanggapan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tgl_tanggapan' => 'required|date',
            'tanggapan' => 'required|string',
            'status' => 'required|string',
        ]);

        // Update the tanggapan based on the correct column 'id_pesanan'
        $tanggapan = Tanggapan::where('id_pesanan', $id)->first();
        
        $tanggapan->update([
            'tgl_tanggapan' => $request->tgl_tanggapan,
            'tanggapan' => $request->tanggapan,
            'status' => $request->status,
        ]);

        Pesanan::where('id_pesanan', $id)->update(['status' => $request->status]);

        return redirect()->route('pesanan.index')->with('message', 'Tanggapan berhasil diperbarui.');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
