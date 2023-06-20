<?php

namespace App\Http\Controllers;

use App\Models\Batch_users;
use App\Models\Ikuti_angkatan;
use Illuminate\Http\Request;

class IkutiAngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ikutis = Ikuti_angkatan::filter(request(['status']))->latest()->paginate(8)->withQueryString();

        return view('batches.batches_ikuti', [
            'ikutis' => $ikutis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ikutis = Ikuti_angkatan::all();

        foreach ($ikutis as $ikuti) {
            if ($ikuti->id_user == $request->id_user && $ikuti->id_batch == $request->id_batch && $ikuti->status != 'tolak') {
                return back()->with('error', 'Permintaan yang sama sudah di kirim!');
            }
            if ($ikuti->id_user == $request->id_user && $ikuti->id_batch == $request->id_batch && $ikuti->status == 'tolak') {
                $ikuti->status = 'pending';
                $ikuti->save();
                return back()->with('success', 'Permintaan untuk mengkuiti angkatan berhasil di kirim!');
            }
        }
        // validation
        $rules = [
            'id_user' => 'required',
            'id_batch' => 'required',
        ];

        $message = [
            'required' => 'Tidak boleh kosong!',
        ];

        $validatedData = $request->validate($rules, $message);

        Ikuti_angkatan::create($validatedData);

        return back()->with('success', 'Permintaan untuk mengkuiti angkatan berhasil di kirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ikuti_angkatan $ikuti_angkatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ikuti_angkatan $ikuti_angkatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $angkatan = Ikuti_angkatan::findOrFail($id);
        // validation
        $rules = [
            'status' => 'required',
        ];

        $message = [
            'required' => 'Tidak boleh kosong!',
        ];

        $validatedData = $request->validate($rules, $message);

        $angkatan->update($validatedData);

        $pesan = '';
        if ($request->status == 'terima') {
            $angkatan_tolaks = Ikuti_angkatan::where([['id_user', $angkatan->id_user], ['id_batch', '!=', $angkatan->id_batch], ['status', 'pending']])->get();
            foreach ($angkatan_tolaks as $tolak) {
                $tolak->status = 'tolak';
                $tolak->save();
            }
            $pesan = 'Permintaan berhasil di terima!';
            Batch_users::create([
                'id_user' => $angkatan->id_user,
                'id_batch' => $angkatan->id_batch,
            ]);
        } else {
            $pesan = 'Permintaan berhasil di tolak!';
        }


        return back()->with('success', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $angkatan = Ikuti_angkatan::findOrFail($id);

        Ikuti_angkatan::destroy($angkatan->id);

        return back()->with('success', 'Permintaan berhasil di hapus!');
    }
}
