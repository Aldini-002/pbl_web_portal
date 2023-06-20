<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Materi;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TaskController extends Controller
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
        return view('tasks.tasks_create', [
            'batch' => Batch::findOrFail($request->id_batch),
            'course' => Course::findOrFail($request->id_course),
            'materi' => Materi::findOrFail($request->id_materi),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $rules = [
            'title' => 'required|min:3',
            'id_batch' => 'required',
            'id_course' => 'required',
            'id_materi' => 'required',
            'start' => 'required',
            'end' => 'required',
            'file' => 'required|file|max:2024'
        ];

        if ($request->description) {
            $rules = array_merge($rules, [
                'description' => 'required',
            ]);
        }

        $message = [
            'required' => 'Tidak boleh kosong!',
            'min' => 'Minimal :min karakter atau lebih!',
            'max' => 'Maksimal :max kb'
        ];

        $validatedData = $request->validate($rules, $message);

        if ($request->file('file')) {
            $file = $request->file('file');
            $file_name = time() . "." . $file->getClientOriginalExtension();
            $file->move('doc/task', $file_name);
            $validatedData['file'] = $file_name;
        }

        Task::create($validatedData);

        return redirect(route('batches-courses-show', $request->id_course) . '?id_batch=' . $request->id_batch)->with('success', 'Tugas berhasi di tambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task_update = Task::all();
        foreach ($task_update as $task) {
            if ($task->start > date(now()) && $task->end > date(now())) {
                $task->status = 'akan datang';
                $task->save();
            } elseif ($task->start < date(now()) && $task->end > date(now())) {
                $task->status = 'berlangsung';
                $task->save();
            } elseif ($task->start < date(now()) && $task->end < date(now())) {
                $task->status = 'selesai';
                $task->save();
            }
        }

        return view('tasks.tasks_detail', [
            'task' => Task::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('tasks.tasks_edit', [
            'task' => Task::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        // validation
        $rules = [
            'title' => 'required|min:3',
            'start' => 'required',
            'end' => 'required',
        ];

        if ($request->description) {
            $rules = array_merge($rules, [
                'description' => 'required',
            ]);
        }

        if ($request->file('file')) {
            $rules = array_merge($rules, [
                'file' => 'required|file|max:2024',
                'file_old' => 'required',
            ]);
        }

        $message = [
            'required' => 'Tidak boleh kosong!',
            'min' => 'Minimal :min karakter atau lebih!',
            'max' => 'Maksimal :max kb'
        ];

        $validatedData = $request->validate($rules, $message);

        if ($request->file('file')) {
            if (File::exists('doc/task/' . $request->file_old)) {
                File::delete('doc/task/' . $request->file_old);
            }
            $file = $request->file('file');
            $file_name = time() . "." . $file->getClientOriginalExtension();
            $file->move('doc/task', $file_name);
            $validatedData['file'] = $file_name;
        }

        $task->update($validatedData);

        return redirect(route('tasks.show', $task->id))->with('success', 'Perubahan berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        if ($task->file) {
            if (File::exists('img/task/' . $task->file)) {
                File::delete('img/task/' . $task->file);
            }
        }

        Task::destroy($task->id);

        return redirect(route('batches-courses-show', $request->id_course) . '?id_batch=' . $request->id_batch)->with('success', 'tugas berhasil di hapus!');
    }
}
