<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function signin()
    {
        return view('auth.signin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function signup()
    {
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $rules = [
            'telepon' => 'required|numeric|min_digits:10|max_digits:20',
            'name' => 'required|min:3|unique:users',
            'age' => 'required|max_digits:3',
            'school_level' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confPassword' => 'required|same:password',
            'image' => 'required|file|image|max:1024'
        ];

        $message = [
            'required' => 'Tidak boleh kosong!',
            'email' => 'Alamat email tidak valid!',
            'min' => 'Minimal :min karakter atau lebih!',
            'same' => 'Konfirmasi password tidak sama!',
            'unique' => ':attribute sudah terdaftar',
            'max_digits' => 'Maksimal :max karakter!',
            'image' => 'File hanya boleh gambar!',
            'max' => 'Maksimal :max kb'
        ];

        $validatedData = $request->validate($rules, $message);

        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = time() . "." . $image->getClientOriginalExtension();
            $image->move('img/user', $image_name);
            $validatedData['image'] = $image_name;
        }

        $user = User::create($validatedData);

        if ($user) {
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Register gagal!');
    }

    /**
     * Display the specified resource.
     */
    public function authenticate(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $message = [
            'required' => 'Tidak boleh kosong!',
            'email' => 'Email tidak valid!'
        ];

        $credentials = $request->validate($rules, $message);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function signout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect('/');
    }
}
