<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Batch_user_history;
use App\Models\Batch_users;
use App\Models\User;
use Illuminate\Http\Request;

class BatchUsersController extends Controller
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
    public function create($id)
    {
        $update_batches = Batch::all();
        foreach ($update_batches as $batch) {
            if ($batch->status == 'selesai') {
                $batch_users_update = Batch_users::where('id_batch', $batch->id)->get();
                foreach ($batch_users_update as $update) {
                    Batch_user_history::create([
                        'id_user' => $update->id_user,
                        'id_batch' => $update->id_batch,
                    ]);

                    $update->delete();
                }
            }
        }

        $batch = Batch::findOrFail($id);
        $users = User::filter(request(['name', 'role', 'age', 'school_level']))->where('role', '!=', 'admin')->paginate(9)->withQueryString();

        return view('batches.batches_users_add', [
            'users' => $users,
            'batch' => $batch,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $rules = [
            'id_batch' => 'required',
            'id_user' => 'required',
        ];

        $message = [
            'required' => 'Tidak boleh kosong!',
        ];

        $validatedData = $request->validate($rules, $message);

        Batch_users::create($validatedData);

        return back()->with('success', 'User berhasil di tambahkan ke angkatan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch_users $batch_users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batch_users $batch_users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batch_users $batch_users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $batch_user = Batch_users::findOrFail($id);

        // if ($batch_user->status != 'selesai') {
        //     return redirect(route('batches.index'))->with('error', 'Hanya angkatan selesai yang bisa dihapus!');
        // }

        Batch_users::destroy($batch_user->id);

        return back()->with('success', 'User berhasil di keluarkan!');
    }
}
