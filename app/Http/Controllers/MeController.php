<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class MeController extends Controller
{
    public function index()
    {
        return view('me.profile', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // validation
        $rules = [];

        if ($request->email && $request->email != $user->email) {
            if (!Hash::check($request->confPassword, $user->password)) {
                return back()->with('error', 'Konfirmasi kata sandi salah!');
            }
            $rules = array_merge($rules, [
                'email' => 'required|email|unique:users',
                'confPassword' => 'required',
            ]);
        }

        if ($request->password) {
            if (!Hash::check($request->password_old, $user->password)) {
                return back()->with('error', 'Kata sandi salah!');
            }
            $rules = array_merge($rules, [
                'password_old' => 'required',
                'password' => 'required|min:6',
                'confPassword' => 'required|same:password',
            ]);
        }

        if ($request->name && $request->name != $user->name) {
            $rules = array_merge($rules, ['name' => 'required|min:3|unique:users',]);
        }

        if ($request->file('image')) {
            $rules = array_merge($rules, [
                'image' => 'required|file|image|max:1024',
                'image_old' => 'required'
            ]);
        }

        if ($request->telepon) {
            $rules = array_merge($rules, ['telepon' => 'required|numeric|min_digits:10|max_digits:20',]);
        }

        if ($request->nik && $request->nik != $user->nik) {
            $rules = array_merge($rules, ['nik' => 'required|unique:users|min_digits:10|max_digits:30',]);
        }

        $message = [
            'required' => 'Tidak boleh kosong!',
            'email' => 'Alamat email tidak valid!',
            'min' => 'Minimal :min karakter atau lebih!',
            'same' => 'Konfirmasi password tidak sama!',
            'unique' => ':attribute sudah terdaftar',
            'image' => 'File hanya boleh gambar!',
            'max' => 'Maksimal :max kb!',
            'max_digits' => 'Maksimal :max karakter!',
            'min_digits' => 'Minimal :min karakter atau lebih!',
        ];

        $validatedData = $request->validate($rules, $message);

        if ($request->file('image')) {
            if (File::exists('img/user/' . $request->image_old)) {
                File::delete('img/user/' . $request->image_old);
            }
            $image = $request->file('image');
            $image_name = time() . "." . $image->getClientOriginalExtension();
            $image->move('img/user', $image_name);
            $validatedData['image'] = $image_name;
        }

        $user->update($validatedData);

        if ($user) {
            return back()->with('success', 'Perubahan berhasil disimpan!');
        }
        return back()->with('error', 'Perubahan gagal disimpan!');
    }
}
