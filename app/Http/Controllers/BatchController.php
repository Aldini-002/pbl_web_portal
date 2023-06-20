<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Batch_courses;
use App\Models\Batch_user_history;
use App\Models\Batch_users;
use App\Models\Course;
use App\Models\Ikuti_angkatan;
use App\Models\Materi;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $update_batches = Batch::all();
        foreach ($update_batches as $batch) {
            if ($batch->start > date(now()) && $batch->end > date(now())) {
                $batch->status = 'akan datang';
                $batch->save();
            } elseif ($batch->start < date(now()) && $batch->end > date(now())) {
                $batch->status = 'berlangsung';
                $batch->save();
            } elseif ($batch->start < date(now()) && $batch->end < date(now())) {
                $batch->status = 'selesai';
                $batch->save();

                $ikutis = Ikuti_angkatan::where('id_batch', $batch->id)->get();
                foreach ($ikutis as $ikuti) {
                    Ikuti_angkatan::destroy($ikuti->id);
                }

                $batch_users = Batch_users::where('id_batch', $batch->id)->get();
                foreach ($batch_users as $batch_user) {
                    Batch_user_history::create([
                        'id_batch' => $batch_user->id_batch,
                        'id_user' => $batch_user->id_user,
                    ]);
                    Batch_users::destroy($batch_user->id);
                }
            }
        }

        $batches = Batch::filter(request(['title', 'status']))->latest()->paginate(8)->withQueryString();
        $batches_diikutis = Batch_users::where('id_user', Auth::user()->id)->latest()->paginate(8)->withQueryString();
        $riwayat_batches_diikutis = Batch_user_history::where('id_user', Auth::user()->id)->latest()->paginate(8)->withQueryString();

        return view('batches.batches', [
            'batches' => $batches,
            'batches_diikutis' => $batches_diikutis,
            'riwayat_batches_diikutis' => $riwayat_batches_diikutis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('batches.batches_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $rules = [
            'title' => 'required|min:3',
            'link_grup' => 'required|url',
            'start' => 'required',
            'end' => 'required',
            'image' => 'required|file|image|max:1024'
        ];

        $message = [
            'required' => 'Tidak boleh kosong!',
            'url' => ':attribute tidak valid!',
            'min' => 'Minimal :min karakter atau lebih!',
            'image' => 'File hanya boleh gambar!',
            'max' => 'Maksimal :max kb'
        ];

        $validatedData = $request->validate($rules, $message);

        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = time() . "." . $image->getClientOriginalExtension();
            $image->move('img/batch', $image_name);
            $validatedData['image'] = $image_name;
        }

        Batch::create($validatedData);

        return redirect(route('batches.index'))->with('success', 'Angkatan berhasi di tambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $update_batches = Batch::all();
        foreach ($update_batches as $batch) {
            if ($batch->start > date(now()) && $batch->end > date(now())) {
                $batch->status = 'akan datang';
                $batch->save();
            } elseif ($batch->start < date(now()) && $batch->end > date(now())) {
                $batch->status = 'berlangsung';
                $batch->save();
            } elseif ($batch->start < date(now()) && $batch->end < date(now())) {
                $batch->status = 'selesai';
                $batch->save();

                $ikutis = Ikuti_angkatan::where('id_batch', $batch->id)->get();
                foreach ($ikutis as $ikuti) {
                    Ikuti_angkatan::destroy($ikuti->id);
                }

                $batch_users = Batch_users::where('id_batch', $batch->id)->get();
                foreach ($batch_users as $batch_user) {
                    Batch_user_history::create([
                        'id_batch' => $batch_user->id_batch,
                        'id_user' => $batch_user->id_user,
                    ]);
                    Batch_users::destroy($batch_user->id);
                }
            }
        }

        $batch = Batch::findOrFail($id);

        $courses = Course::all();

        return view('batches.batches_detail', [
            'batch' => $batch,
            'courses' => $courses,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $batch = Batch::findOrFail($id);
        return view('batches.batches_edit', [
            'batch' => $batch,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);

        // validation
        $rules = [
            'title' => 'required|min:3',
            'link_grup' => 'required|url',
            'start' => 'required',
            'end' => 'required',
        ];

        if ($request->file('image')) {
            $rules = array_merge($rules, [
                'image' => 'required|file|image|max:1024',
                'image_old' => 'required'
            ]);
        }

        $message = [
            'required' => 'Tidak boleh kosong!',
            'url' => ':attribute tidak valid!',
            'min' => 'Minimal :min karakter atau lebih!',
            'image' => 'File hanya boleh gambar!',
            'max' => 'Maksimal :max kb'
        ];

        $validatedData = $request->validate($rules, $message);

        if ($request->file('image')) {
            if (File::exists('img/batch/' . $request->image_old)) {
                File::delete('img/batch/' . $request->image_old);
            }
            $image = $request->file('image');
            $image_name = time() . "." . $image->getClientOriginalExtension();
            $image->move('img/batch', $image_name);
            $validatedData['image'] = $image_name;
        }

        $batch->update($validatedData);

        return redirect(route('batches.show', $id))->with('success', 'Perubahan berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);

        if ($batch->status != 'selesai') {
            return redirect(route('batches.index'))->with('error', 'Hanya angkatan yang telah selesai yang bisa dihapus!');
        }

        if ($batch->batch_course->count()) {
            $batch_courses = Batch_courses::where('id_batch', $id);
            $batch_courses->delete();
        }

        if ($batch->batch_user->count()) {
            $batch_users = Batch_users::where('id_batch', $id);
            $batch_users->delete();
        }

        if ($batch->task->count()) {
            $task = Task::where('id_batch', $id);
            $task->delete();
        }

        if ($batch->batch_user_history->count()) {
            $batch_user_history = Batch_user_history::where('id_batch', $id);
            $batch_user_history->delete();
        }

        if ($batch->ikuti_angkatan->count()) {
            $ikuti_angkatan = Ikuti_angkatan::where('id_batch', $id);
            $ikuti_angkatan->delete();
        }

        if ($batch->image) {
            if (File::exists('img/batch/' . $batch->image)) {
                File::delete('img/batch/' . $batch->image);
            }
        }

        Batch::destroy($batch->id);

        return redirect(route('batches.index'))->with('success', 'Angkatan berhasil di hapus!');
    }

    public function show_course($id)
    {
        $batch = Batch::findOrFail(request('id_batch'));
        $course = Course::findOrFail($id);
        $materis = Materi::where('id_course', $course->id)->get();
        $tasks = Task::where([
            ['id_batch', $batch->id],
            ['id_course', $course->id]
        ])->get();

        $view = 'batches.admin.batches_courses_detail';
        if (Auth::user()->role == 'siswa') {
            $view = 'batches.siswa.batches_courses_detail';
        }
        if (Auth::user()->role == 'instruktur') {
            $view = 'batches.instruktur.batches_courses_detail';
        }

        return view($view, [
            'batch' => $batch,
            'course' => $course,
            'materis' => $materis,
            'tasks' => $tasks,
        ]);
    }
}
