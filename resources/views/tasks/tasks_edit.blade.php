@extends('layouts.main')
@section('content')
    <div class="card">
        <!--begin::Body-->
        <div class="card-body p-lg-17">

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

            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-0 me-lg-20">
                    <!--begin::Job-->
                    <div class="">
                        <!--begin::Description-->
                        <div class="m-0">
                            <!--begin::Title-->
                            <h4 class="fs-1 text-gray-800 w-bolder mb-6">Ubah tugas</h4>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <!--end::Text-->
                        </div>
                        <!--end::Description-->

                        <hr>

                        <!--begin::Section-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle gs-0 gy-4">
                                <!--begin::Table body-->
                                <form action="{{ route('tasks.update', $task->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="file_old" value="{{ $task->file }}">
                                    <tbody>
                                        <tr>
                                            <th class="ps-4 min-w-50px">Judul</th>
                                            <td>
                                                <input type="text" name="title"
                                                    class="form-control form-control-solid @error('title') is-invalid @enderror"
                                                    required autocomplete="off" value="{{ $task->title }}">
                                                @error('title')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="ps-4 min-w-50px">Tanggal mulai</th>
                                            <td>
                                                <input type="date" name="start"
                                                    class="form-control form-control-solid @error('start') is-invalid @enderror"
                                                    required value="{{ $task->start }}">
                                                @error('start')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="ps-4 min-w-50px">Batas waktu</th>
                                            <td>
                                                <input type="date" name="end"
                                                    class="form-control form-control-solid @error('end') is-invalid @enderror"
                                                    required value="{{ $task->end }}">
                                                @error('end')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="ps-4 min-w-50px">Deskripsi</th>
                                            <td>
                                                <textarea name="description" rows="3"
                                                    class="form-control form-control-solid @error('description') is-invalid @enderror" placeholder="opsional...">{{ $task->description }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="ps-4 min-w-50px">File tugas</th>
                                            <td>
                                                <input type="file" name="file"
                                                    class="form-control form-control-solid @error('file') is-invalid @enderror"
                                                    accept=".pdf">
                                                @error('file')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end">
                                                <a
                                                    href="{{ route('tasks.show', $task->id) }}"class="btn btn-light">Batal</a>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </form>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Job-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Body-->
    </div>
@endsection
