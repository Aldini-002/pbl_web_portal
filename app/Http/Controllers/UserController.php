<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Batch_users;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::filter(request(['name', 'role']))->paginate(9)->withQueryString();

        return view('user.users', [
            'users' => $users,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.user_detail', [
            'user' => User::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // validation
        $rules = [
            'role' => 'required',
        ];

        $message = [
            'required' => 'Tidak boleh kosong!',
        ];

        if ($request->role === $user->role) {
            return back()->with('error', 'Role gagal diubah!');
        }

        $validatedData = $request->validate($rules, $message);

        $user->update($validatedData);

        if ($user) {
            return back()->with('success', 'Perubahan berhasil disimpan!');
        }
        return back()->with('error', 'Perubahan gagal disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat menghapus admin!');
        }

        if ($user->batch_user->count()) {
            $batch_users = Batch_users::where('id_user', $id);
            $batch_users->delete();
        }

        if ($user->image) {
            if (File::exists('img/user/' . $user->image)) {
                File::delete('img/user/' . $user->image);
            }
        }

        User::destroy($user->id);

        return redirect(route('user.index'))->with('success', 'Hapus user berhasil!');
    }
}
