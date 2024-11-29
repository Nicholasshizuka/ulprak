<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Paket;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek role user
        $user = auth()->user();

        if ($user->role > 1) {
            // Jika role > 1, tampilkan semua data pesanan
            $pesanans = Pesanan::latest()->paginate(5);
        } else {
            // Jika role = 0, hanya tampilkan data pesanan milik user
            $pesanans = Pesanan::latest()
                ->where('user_id', $user->id)
                ->paginate(5);
        }

        // Fetch paket data (jika diperlukan)
        $pakets = Paket::latest()->paginate(10);

        // Return view dengan data
        return view('home', compact('pesanans', 'pakets'));
    }

    /**
     * Show the details of a specific pesanan.
     */
    public function show($id)
    {
        $pesanan = Pesanan::with('user')->findOrFail($id);

        return view('pesanan.show', compact('pesanan'));
    }

    /**
     * Show the form for creating a new pesanan.
     */
    public function create()
    {
        // Fetch all available pakets
        $pakets = Paket::all();
        
        return view('pesanan.create', compact('pakets'));
    }

    /**
     * Store a newly created pesanan.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $this->validate($request, [
            'id_paket' => 'required|integer',
            'detail' => 'required|string',
            'tgl_pesanan' => 'required|date',
            'foto' => 'nullable|mimes:png,jpg,jpeg',
            'status' => 'required|in:Proses,Selesai',
        ]);
        

        // Check if the file is uploaded
        $foto = null;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            
            // Generate a unique filename based on current timestamp
            $foto = time() . '.' . $image->getClientOriginalExtension();
            
            // Define the destination path
            $destinationPath = public_path('/images/pesanan');
            
            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true); // Recursively create directories if needed
            }
            
            // Move the uploaded file to the target directory
            $image->move($destinationPath, $foto);
        }

        // Store the pesanan in the database
        Pesanan::create([
            'user_id' => auth()->id(),
            'id_paket' => $request->get('id_paket'),
            'detail' => $request->get('detail'),
            'tgl_pesanan' => $request->get('tgl_pesanan'),
            'foto' => $foto,
            'status' => $request->get('status'),
        ]);

        return redirect()->route('home')->with('message', 'Pesanan berhasil dibuat.');
    }




    /**
     * Show the form for editing an existing pesanan.
     */
    public function edit($id)
    {
        // Fetch the pesanan by ID and the available pakets
        $pesanan = Pesanan::findOrFail($id);
        $pakets = Paket::all();
        
        return view('pesanan.edit', compact('pesanan', 'pakets'));
    }

    /**
     * Update the specified pesanan.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_paket' => 'required|integer',
            'detail' => 'required|string',
            'tgl_pesanan' => 'required|date',
            'foto' => 'nullable|mimes:png,jpg,jpeg',
            'status' => 'required|in:Proses,Selesai',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->id_paket = $request->get('id_paket');
        $pesanan->detail = $request->get('detail');
        $pesanan->tgl_pesanan = $request->get('tgl_pesanan');
        $pesanan->status = $request->get('status');

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $foto = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/pesanan');
            $image->move($destinationPath, $foto);
            $pesanan->foto = $foto;
        }

        $pesanan->save();

        return redirect()->route('home')->with('message', 'Pesanan berhasil diupdate.');
    }

    /**
     * Remove the specified pesanan.
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('home')->with('message', 'Pesanan berhasil dihapus.');
    }
}
