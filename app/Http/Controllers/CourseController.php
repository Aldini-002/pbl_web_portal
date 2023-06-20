<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Batch_courses;
use App\Models\Category;
use App\Models\Course;
use App\Models\Materi;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        $courses = Course::filter(request(['title', 'id_category']))->latest()->paginate(8)->withQueryString();

        return view('courses.courses', [
            'courses' => $courses,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('courses.courses_create', [
            'categories' => $categories,
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
            'id_category' => 'required',
            'description' => 'required|min:3',
            'image' => 'required|file|image|max:1024'
        ];

        $message = [
            'required' => 'Tidak boleh kosong!',
            'min' => 'Minimal :min karakter atau lebih!',
            'image' => 'File hanya boleh gambar!',
            'max' => 'Maksimal :max kb'
        ];

        $validatedData = $request->validate($rules, $message);

        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = time() . "." . $image->getClientOriginalExtension();
            $image->move('img/course', $image_name);
            $validatedData['image'] = $image_name;
        }

        Course::create($validatedData);

        return redirect(route('courses.index'))->with('success', 'Pelatihan berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        $materis = Materi::where('id_course', $course->id)->get();

        return view('courses.courses_detail', [
            'course' => $course,
            'materis' => $materis,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::orderBy('name')->get();
        $course = Course::findOrFail($id);

        return view('courses.courses_edit', [
            'categories' => $categories,
            'course' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // validation
        $rules = [
            'title' => 'required|min:3',
            'id_category' => 'required',
            'description' => 'required|min:3',
        ];

        if ($request->file('image')) {
            $rules = array_merge($rules, [
                'image' => 'required|file|image|max:1024',
                'image_old' => 'required'
            ]);
        }

        $message = [
            'required' => 'Tidak boleh kosong!',
            'min' => 'Minimal :min karakter atau lebih!',
            'image' => 'File hanya boleh gambar!',
            'max' => 'Maksimal :max kb!',
        ];

        $validatedData = $request->validate($rules, $message);

        if ($request->file('image')) {
            if (File::exists('img/course/' . $request->image_old)) {
                File::delete('img/course/' . $request->image_old);
            }
            $image = $request->file('image');
            $image_name = time() . "." . $image->getClientOriginalExtension();
            $image->move('img/course', $image_name);
            $validatedData['image'] = $image_name;
        }

        $course->update($validatedData);

        return redirect(route('courses.show', $id))->with('success', 'Perubahan berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if ($course->materi->count()) {
            $materis = Materi::where('id_course', $id);
            $materis->delete();
        }

        if ($course->batch_course->count()) {
            $batch_courses = Batch_courses::where('id_course', $id);
            $batch_courses->delete();
        }

        if ($course->task->count()) {
            $task = Task::where('id_course', $id);
            $task->delete();
        }

        if ($course->image) {
            if (File::exists('img/course/' . $course->image)) {
                File::delete('img/course/' . $course->image);
            }
        }

        Course::destroy($course->id);

        return redirect(route('courses.index'))->with('success', 'Pelatihan berhasil di hapus!');
    }
}
