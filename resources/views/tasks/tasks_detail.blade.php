@extends('layouts.main')
@section('content')
    <div class="card">
        <!--begin::Body-->
        <div class="card-body p-lg-17">

            <div class="mb-3">
                <a href="{{ route('batches-courses-show', $task->id_course) . '?id_batch=' . $task->id_batch }}"
                    class="btn btn-sm btn-primary">Kembali</a>
                @can('instruktur')
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Ubah tugas</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id_batch" value="{{ $task->id_batch }}">
                        <input type="hidden" name="id_course" value="{{ $task->id_course }}">
                        <button type="submit" class="btn btn-danger btn-sm">Hapus tugas</button>
                    </form>
                @endcan
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

            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-0 me-lg-20">
                    <!--begin::Job-->
                    <div class="">
                        <!--begin::Description-->
                        <div class="m-0">
                            <!--begin::Title-->
                            <h4 class="fs-1 text-gray-800 w-bolder mb-6">{{ $task->title }}</h4>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                {{ $task->description != null ? $task->description : '' }}
                            </p>
                            <!--end::Text-->
                        </div>
                        <!--end::Description-->

                        <hr>

                        <!--begin::Accordion-->
                        <!--begin::Section-->
                        <p class="fw-semibold fs-4 text-gray-600 mb-2">STATUS</p>

                        <!--begin::Section-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle gs-0 gy-4">
                                <!--begin::Table body-->
                                <tbody>
                                    <tr class="border">
                                        <th class="ps-4 min-w-50px rounded-start">Status</th>
                                        <th class="ps-4 min-w-500px border-start"><span
                                                class="badge badge-light-{{ $task->status == 'akan datang' ? 'warning' : '' }}{{ $task->status == 'berlangsung' ? 'success' : '' }}{{ $task->status == 'selesai' ? 'danger' : '' }} rounded-end">{{ $task->status }}</span>
                                        </th>
                                    </tr>
                                    <tr class="border">
                                        <th class="ps-4 min-w-50px">Waktu mulai</th>
                                        <td class="ps-4 min-w-500px border-start">{{ $task->start }}</td>
                                    </tr>
                                    <tr class="border">
                                        <th class="ps-4 min-w-50px">Batas waktu</th>
                                        <td class="ps-4 min-w-500px border-start">{{ $task->end }}</td>
                                    </tr>
                                    <tr class="border">
                                        <th class="ps-4 min-w-50px">File tugas</th>
                                        <td class="ps-4 min-w-500px border-start"><a href="/doc/task/{{ $task->file }}"
                                                target="blank">{{ $task->title }}</a></td>
                                    </tr>
                                    @can('instruktur')
                                        <tr>
                                            <td colspan="2" class="text-end"><a href="{{ route('comingsoon') }}"
                                                    class="btn btn-primary">Cek jawaban siswa</a>
                                            </td>
                                        </tr>
                                    @endcan
                                </tbody>
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


    {{-- kumpul tugas --}}
    @can('siswa')
        <div class="card mb-5 mb-xl-8 col mt-15">
            <div class="card-body py-3">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid me-0 me-lg-20">
                        <!--begin::Job-->
                        <div class="">
                            <!--begin::Description-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <h4 class="fs-1 text-gray-800 w-bolder mb-6">Kumpul tugas</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Description-->

                            <hr>

                            <!--begin::Accordion-->
                            <!--begin::Section-->
                            <p class="fw-semibold fs-4 text-gray-600 mb-2">STATUS</p>

                            <!--begin::Section-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle gs-0 gy-4">
                                    <!--begin::Table body-->
                                    <tbody>
                                        <tr class="border">
                                            <th class="ps-4 min-w-50px rounded-start">Status</th>
                                            <th class="ps-4 min-w-500px border-start"><span
                                                    class="badge badge-light-warning rounded-end">belum selesai</span>
                                            </th>
                                        </tr>
                                        <tr class="border">
                                            <th class="ps-4 min-w-50px">Waktu pengumpulan</th>
                                            <td class="ps-4 min-w-500px border-start">-</td>
                                        </tr>
                                        <tr class="border">
                                            <th class="ps-4 min-w-50px">File jawaban</th>
                                            <td class="ps-4 min-w-500px border-start">
                                                <input type="file" name="answer" class="form-control form-control-solid"
                                                    required accept=".pdf">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end"><button type="submit"
                                                    class="btn btn-primary">Kumpulkan</button>
                                            </td>
                                        </tr>
                                    </tbody>
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
        </div>
    @endcan
    {{-- end kumpul tugas --}}
@endsection
