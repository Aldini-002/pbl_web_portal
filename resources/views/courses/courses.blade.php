@extends('layouts.main')
@section('content')
    <div class="card mb-5 mb-xl-8 col">
        <div class="card-body py-3">

            <div class="mb-3">
                <a href="{{ route('courses.create') }}" class="btn btn-sm btn-primary">Tambah course</a>
            </div>

            <div class="mb-3">
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <form action="{{ route('courses.index') }}" class="d-inline mb-3">
                <div class="row mb-6">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="fv-row mb-0">
                            <input type="text" name="title" value="{{ request('title') }}"
                                class="form-control form-control-solid" placeholder="judul...">
                        </div>
                    </div>
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="fv-row mb-0">
                            <select name="id_category" data-control="select2"
                                class="form-select form-select-solid fw-semibold">
                                <option value="" selected>
                                    {{ !request('id_category') ? 'Pilih kategori...' : 'Kosongkan...' }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('id_category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg mb-4 mb-lg-0">
                        <div class="fv-row mb-0">
                            <button type="submit" class="btn btn-primary" style="width: 100%">Filter</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row g-5 g-xl-8">
                @foreach ($courses as $course)
                    <div class="col-xl-3">
                        <!--begin::Mixed Widget 12-->
                        <a href="{{ route('courses.show', $course->id) }}">
                            <div class="card card-xl-stretch mb-xl-8 shadow-sm">
                                <img src="/img/course/{{ $course->image }}" class="card-img-top" alt="error"
                                    style="height: 200px; overflow:hidden">
                                <div class="card-body text-center text-dark">
                                    <h5 class="card-title">{{ $course->title }}</h5>
                                    <span
                                        class="badge badge-light-info fw-semibold me-1">{{ $course->category->name }}</span>
                                    <hr>
                                    <small
                                        class="card-text">{{ $course->materi->count() ? $course->materi->count() : 'Tidak ada materi' }}</small>
                                </div>
                            </div>
                        </a>
                        <!--end::Mixed Widget 12-->
                    </div>
                @endforeach
                <div class="mb-5">
                    {{ $courses->links() }}
                </div>
                @if (!$courses->count())
                    Tidak ada pelatihan
                @endif
                <!--end::Col-->
            </div>

        </div>
    </div>
@endsection
