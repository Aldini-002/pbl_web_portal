@extends('layouts.main')
@section('content')
    @if (Auth::user()->role != 'admin')
        <div class="card mb-5 mb-xl-8 col">
            <!--begin::Body-->
            <div class="card-body py-3">
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

                @can('admin')
                    <div class="mb-3">
                        <a href="{{ route('batches.create') }}" class="btn btn-sm btn-primary">Tambah batch</a>
                    </div>

                    <form action="{{ route('batches.index') }}" class="d-inline mb-3">
                        <div class="row mb-6">
                            <div class="col-lg-5 mb-4 mb-lg-0">
                                <div class="fv-row mb-0">
                                    <input type="text" name="title" value="{{ request('title') }}"
                                        class="form-control form-control-solid" placeholder="judul...">
                                </div>
                            </div>
                            <div class="col-lg-5 mb-4 mb-lg-0">
                                <div class="fv-row mb-0">
                                    <select name="status" class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true">
                                        <option {{ !request('status') ? 'selected disabled' : '' }} value="">
                                            {{ request('status') ? 'Kosongkan' : 'status...' }}</option>
                                        <option value="akan datang" {{ request('status') === 'akan datang' ? 'selected' : '' }}>
                                            Akan
                                            datang
                                        </option>
                                        <option value="berlangsung" {{ request('status') === 'berlangsung' ? 'selected' : '' }}>
                                            Berlangsung</option>
                                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai
                                        </option>
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
                @endcan

                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr>
                                <th colspan="5" class="fw-bold text-muted text-light">
                                    Angkatan Diikuti
                                </th>
                            </tr>
                            <tr class="fw-bold text-muted bg-dark">
                                <th class="ps-4 min-w-325px rounded-start">Angkatan</th>
                                <th class="ps-4 min-w-200px ">Status</th>
                                <th class="ps-4 min-w-200px ">Tanggal mulai</th>
                                <th class="ps-4 min-w-200px ">Tanggal selesai</th>
                                <th class="min-w-200px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach ($batches_diikutis as $batch)
                                @continue($batch->batch->status == 'selesai')
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <img src="/img/batch/{{ $batch->batch->image }}" class=""
                                                    alt="error" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="{{ route('batches.show', $batch->batch->id) }}"
                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $batch->batch->title }}</a>
                                                <span
                                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $batch->batch->batch_user->count() ? $batch->batch->batch_user->count() . ' Peserta' : 'Belum ada peserta' }}</span>
                                                <span
                                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $batch->batch->batch_course->count() ? $batch->batch->batch_course->count() . ' Pelatihan' : 'Belum ada pelatihan' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge fw-semibold me-1 badge-light-{{ $batch->batch->status === 'akan datang' ? 'warning' : '' }}{{ $batch->batch->status === 'berlangsung' ? 'success' : '' }}{{ $batch->batch->status === 'selesai' ? 'danger' : '' }}">{{ $batch->batch->status }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $batch->batch->start }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $batch->batch->end }}</span>
                                    </td>
                                    <td class="text-end">
                                        @can('admin')
                                            <a href="{{ route('batches.edit', $batch->batch->id) }}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3"
                                                            d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <form action="{{ route('batches.destroy', $batch->batch->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button id="kt_account_deactivate_account_submit" type="submit"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                    onclick="return confirm('Angkatan akan dihapus secara permanen!\nlanjutkan')">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.5"
                                                                d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.5"
                                                                d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">{{ $batches_diikutis->links() }}</td>
                            </tr>
                            @if (!$batches_diikutis->count())
                                Tidak ada angkatan diikuti
                            @endif
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>


        <div class="card mb-5 mb-xl-8 col">
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="mb-3">
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                @can('admin')
                    <div class="mb-3">
                        <a href="{{ route('batches.create') }}" class="btn btn-sm btn-primary">Tambah batch</a>
                    </div>

                    <form action="{{ route('batches.index') }}" class="d-inline mb-3">
                        <div class="row mb-6">
                            <div class="col-lg-5 mb-4 mb-lg-0">
                                <div class="fv-row mb-0">
                                    <input type="text" name="title" value="{{ request('title') }}"
                                        class="form-control form-control-solid" placeholder="judul...">
                                </div>
                            </div>
                            <div class="col-lg-5 mb-4 mb-lg-0">
                                <div class="fv-row mb-0">
                                    <select name="status" class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true">
                                        <option {{ !request('status') ? 'selected disabled' : '' }} value="">
                                            {{ request('status') ? 'Kosongkan' : 'status...' }}</option>
                                        <option value="akan datang"
                                            {{ request('status') === 'akan datang' ? 'selected' : '' }}>
                                            Akan
                                            datang
                                        </option>
                                        <option value="berlangsung"
                                            {{ request('status') === 'berlangsung' ? 'selected' : '' }}>
                                            Berlangsung</option>
                                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>
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
                @endcan

                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr>
                                <th colspan="5" class="fw-bold text-muted text-light">
                                    Riwayat Angkatan Diikuti
                                </th>
                            </tr>
                            <tr class="fw-bold text-muted bg-dark">
                                <th class="ps-4 min-w-325px rounded-start">Angkatan</th>
                                <th class="ps-4 min-w-200px ">Status</th>
                                <th class="ps-4 min-w-200px ">Tanggal mulai</th>
                                <th class="ps-4 min-w-200px ">Tanggal selesai</th>
                                <th class="min-w-200px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach ($riwayat_batches_diikutis as $batch)
                                @continue($batch->batch->status != 'selesai')
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <img src="/img/batch/{{ $batch->batch->image }}" class=""
                                                    alt="error" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="{{ route('batches.show', $batch->batch->id) }}"
                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $batch->batch->title }}</a>
                                                <span
                                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $batch->batch->batch_user_history->count() ? $batch->batch->batch_user_history->count() . ' Peserta' : 'Belum ada peserta' }}</span>
                                                <span
                                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $batch->batch->batch_course->count() ? $batch->batch->batch_course->count() . ' Pelatihan' : 'Belum ada pelatihan' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge fw-semibold me-1 badge-light-{{ $batch->batch->status === 'akan datang' ? 'warning' : '' }}{{ $batch->batch->status === 'berlangsung' ? 'success' : '' }}{{ $batch->batch->status === 'selesai' ? 'danger' : '' }}">{{ $batch->batch->status }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $batch->batch->start }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $batch->batch->end }}</span>
                                    </td>
                                    <td class="text-end">
                                        @can('admin')
                                            <a href="{{ route('batches.edit', $batch->batch->id) }}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3"
                                                            d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <form action="{{ route('batches.destroy', $batch->batch->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button id="kt_account_deactivate_account_submit" type="submit"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                    onclick="return confirm('Angkatan akan dihapus secara permanen!\nlanjutkan')">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.5"
                                                                d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.5"
                                                                d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">{{ $riwayat_batches_diikutis->links() }}</td>
                            </tr>
                            @if (!$riwayat_batches_diikutis->count())
                                Tidak ada riwayat angkatan
                            @endif
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
    @endif


    @if (Auth::user()->role != 'instruktur')
        <div class="card mb-5 mb-xl-8 col">
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="mb-3">
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                @can('admin')
                    <div class="mb-3">
                        <a href="{{ route('batches.create') }}" class="btn btn-sm btn-primary">Tambah batch</a>
                    </div>
                @endcan

                <form action="{{ route('batches.index') }}" class="d-inline mb-3">
                    <div class="row mb-6">
                        <div class="col-lg-{{ Auth::user()->role == 'admin' ? 5 : 10 }} mb-4 mb-lg-0">
                            <div class="fv-row mb-0">
                                <input type="text" name="title" value="{{ request('title') }}"
                                    class="form-control form-control-solid" placeholder="judul...">
                            </div>
                        </div>
                        @can('admin')
                            <div class="col-lg-5 mb-4 mb-lg-0">
                                <div class="fv-row mb-0">
                                    <select name="status" class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true">
                                        <option {{ !request('status') ? 'selected disabled' : '' }} value="">
                                            {{ request('status') ? 'Kosongkan' : 'status...' }}</option>
                                        <option value="akan datang"
                                            {{ request('status') === 'akan datang' ? 'selected' : '' }}>
                                            Akan datang
                                        </option>
                                        <option value="berlangsung"
                                            {{ request('status') === 'berlangsung' ? 'selected' : '' }}>
                                            Berlangsung</option>
                                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>
                                    </select>
                                </div>
                            </div>
                        @endcan
                        <div class="col-lg mb-4 mb-lg-0">
                            <div class="fv-row mb-0">
                                <button type="submit" class="btn btn-primary" style="width: 100%">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr>
                                <td colspan="5" class="fw-bold text-muted text-light">
                                    Semua Angkatan
                                </td>
                            </tr>
                            <tr class="fw-bold text-muted bg-dark">
                                <th class="ps-4 min-w-325px rounded-start">Angkatan</th>
                                <th class="ps-4 min-w-200px ">Status</th>
                                <th class="ps-4 min-w-200px ">Tanggal mulai</th>
                                <th class="ps-4 min-w-200px ">Tanggal selesai</th>
                                <th class="min-w-200px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach ($batches as $batch)
                                @can('siswa')
                                    @continue($batch->status != 'akan datang')
                                @endcan
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <img src="/img/batch/{{ $batch->image }}" class=""
                                                    alt="error" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="{{ route('batches.show', $batch->id) }}"
                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $batch->title }}</a>
                                                @if ($batch->status == 'selesai')
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $batch->batch_user_history->count() ? $batch->batch_user_history->count() . ' Peserta' : 'Belum ada peserta' }}</span>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $batch->batch_course->count() ? $batch->batch_course->count() . ' Pelatihan' : 'Belum ada pelatihan' }}</span>
                                                @else
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $batch->batch_user->count() ? $batch->batch_user->count() . ' Peserta' : 'Belum ada peserta' }}</span>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $batch->batch_course->count() ? $batch->batch_course->count() . ' Pelatihan' : 'Belum ada pelatihan' }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge fw-semibold me-1 badge-light-{{ $batch->status === 'akan datang' ? 'warning' : '' }}{{ $batch->status === 'berlangsung' ? 'success' : '' }}{{ $batch->status === 'selesai' ? 'danger' : '' }}">{{ $batch->status }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $batch->start }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $batch->end }}</span>
                                    </td>
                                    <td class="text-end">
                                        @can('admin')
                                            <a href="{{ route('batches.edit', $batch->id) }}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3"
                                                            d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <form action="{{ route('batches.destroy', $batch->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button id="kt_account_deactivate_account_submit" type="submit"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                    onclick="return confirm('Angkatan akan dihapus secara permanen!\nlanjutkan')">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.5"
                                                                d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.5"
                                                                d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">{{ $batches->links() }}</td>
                            </tr>
                            @if (!$batches->count())
                                Tidak ada angkatan
                            @endif
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
    @endif
@endsection
