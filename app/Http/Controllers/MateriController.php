<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MateriController extends Controller
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
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $rules = [
            'title' => 'required|min:3',
            'id_course' => 'required',
            'materi' => 'required|file|max:2024'
        ];

        $message = [
            'required' => 'Tidak boleh kosong!',
            'min' => 'Minimal :min karakter atau lebih!',
            'max' => 'Maksimal :max kb'
        ];

        $validatedData = $request->validate($rules, $message);

        if ($request->file('materi')) {
            $materi = $request->file('materi');
            $materi_name = time() . "." . $materi->getClientOriginalExtension();
            $materi->move('doc/materi', $materi_name);
            $validatedData['materi'] = $materi_name;
        }

        Materi::create($validatedData);

        return back()->with('success', 'Materi berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materi $materi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        // validation
        $rules = [
            'title' => 'required|min:3',
        ];

        if ($request->file('materi')) {
            $rules = array_merge($rules, [
                'materi' => 'required|file|max:2024',
                'materi_old' => 'required'
            ]);
        }

        $message = [
            'required' => 'Tidak boleh kosong!',
            'min' => 'Minimal :min karakter atau lebih!',
            'max' => 'Maksimal :max kb'
        ];

        $validatedData = $request->validate($rules, $message);

        if ($request->file('materi')) {
            if (File::exists('doc/materi/' . $request->materi_old)) {
                File::delete('doc/materi/' . $request->materi_old);
            }
            $materi_file = $request->file('materi');
            $materi_name = time() . "." . $materi_file->getClientOriginalExtension();
            $materi_file->move('doc/materi', $materi_name);
            $validatedData['materi'] = $materi_name;
        }

        $materi->update($validatedData);

        return back()->with('success', 'Perubahan berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        if ($materi->image) {
            if (File::exists('doc/materi/' . $materi->image)) {
                File::delete('doc/materi/' . $materi->image);
            }
        }

        Materi::destroy($materi->id);

        return back()->with('success', 'Materi berhasil dihapus!');
    }
}
