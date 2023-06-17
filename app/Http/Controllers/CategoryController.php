<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::filter(request(['name']))->orderBy('name')->paginate(9)->withQueryString();

        return view('categories.categories', [
            'categories' => $categories,
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
        $rules = [
            'name' => 'required|unique:categories',
        ];

        $message = [
            'required' => 'Tidak boleh kosong!',
            'unique' => 'Nama sudah digunakan!',
        ];

        $validatedData = $request->validate($rules, $message);

        Category::create($validatedData);

        return back()->with('success', 'Kategori berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $rules = [];

        if ($request->name !== $category->name) {
            $rules = [
                'name' => 'required|unique:categories',
            ];
        }

        $message = [
            'required' => 'Tidak boleh kosong!',
            'unique' => 'Nama sudah digunakan!',
        ];

        $validatedData = $request->validate($rules, $message);

        $category->update($validatedData);

        return back()->with('success', 'Kategori berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        Category::destroy($category->id);

        return redirect(route('categories.index'))->with('success', 'Hapus kategori berhasil!');
    }
}
