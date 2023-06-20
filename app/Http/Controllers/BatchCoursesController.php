<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Batch_courses;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class BatchCoursesController extends Controller
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
        $batch = Batch::findOrFail($id);
        $courses = Course::filter(request(['title', 'id_category']))->latest()->paginate(8)->withQueryString();
        $categories = Category::latest()->get();
        $batch_courses = Batch_courses::where('id_batch', '!=', $id)->get();

        return view('batches.batches_courses_add', [
            'courses' => $courses,
            'categories' => $categories,
            'batch' => $batch,
            'batch_courses' => $batch_courses,
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
            'id_course' => 'required',
        ];

        $message = [
            'required' => 'Tidak boleh kosong!',
        ];

        $validatedData = $request->validate($rules, $message);

        Batch_courses::create($validatedData);

        return back()->with('success', 'Pelatihan berhasil di tambahkan ke angkatan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch_courses $batch_courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batch_courses $batch_courses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batch_courses $batch_courses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $batch_course = Batch_courses::findOrFail($id);

        // if ($batch_course->status != 'selesai') {
        //     return redirect(route('batches.index'))->with('error', 'Hanya angkatan selesai yang bisa dihapus!');
        // }

        Batch_courses::destroy($batch_course->id);

        return back()->with('success', 'Pelatihan berhasil di keluarkan!');
    }
}
