@extends('layouts.main')
@section('content')
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

            <form action="{{ route('ikuti.index') }}" class="d-inline mb-3">
                <div class="row mb-6">
                    <div class="col-lg mb-4 mb-lg-0">
                        <div class="fv-row mb-0">
                            <select name="status" class="form-select" data-control="select2" data-hide-search="true">
                                <option {{ !request('status') ? 'selected disabled' : '' }} value="">
                                    {{ request('status') ? 'Kosongkan' : 'status...' }}</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>pending
                                </option>
                                <option value="terima" {{ request('status') === 'terima' ? 'selected' : '' }}>
                                    terima</option>
                                <option value="tolak" {{ request('status') === 'tolak' ? 'selected' : '' }}>tolak
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 mb-4 mb-lg-0">
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
                        <tr class="fw-bold text-muted bg-dark">
                            <th class="ps-4 min-w-325px rounded-start">Profile</th>
                            <th class="ps-4 min-w-325px ">Angkatan</th>
                            <th class="ps-4 min-w-200px ">Status</th>
                            <th class="min-w-200px text-end rounded-end"></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($ikutis as $ikuti)
                            @can('siswa')
                                @continue($ikuti->id_user != Auth::user()->id)
                            @endcan
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-5">
                                            <img src="/img/user/{{ $ikuti->user->image }}" class="" alt="error" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-dark fw-bold mb-1 fs-6">{{ $ikuti->user->name }}</span>
                                            <span
                                                class="text-muted fw-semibold text-muted d-block fs-7">{{ $ikuti->user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-5">
                                            <img src="/img/batch/{{ $ikuti->batch->image }}" class=""
                                                alt="error" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-dark fw-bold mb-1 fs-6">{{ $ikuti->batch->title }}</sp>
                                                @if ($ikuti->batch->status == 'selesai')
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $ikuti->batch->batch_user_history->count() ? $ikuti->batch->batch_user_history->count() . ' Peserta' : 'Belum ada peserta' }}</span>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $ikuti->batch->batch_course->count() ? $ikuti->batch->batch_course->count() . ' Pelatihan' : 'Belum ada pelatihan' }}</span>
                                                @else
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $ikuti->batch->batch_user->count() ? $ikuti->batch->batch_user->count() . ' Peserta' : 'Belum ada peserta' }}</span>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $ikuti->batch->batch_course->count() ? $ikuti->batch->batch_course->count() . ' Pelatihan' : 'Belum ada pelatihan' }}</span>
                                                @endif
                                        </div>
                                    </div>
                                <td>
                                    <span
                                        class="badge badge-light-{{ $ikuti->status === 'tolak' ? 'danger' : '' }}{{ $ikuti->status === 'pending' ? 'info' : '' }}{{ $ikuti->status === 'terima' ? 'success' : '' }} fw-semibold me-1">{{ $ikuti->status }}</span>
                                </td>
                                <td class="text-end">
                                    @can('admin')
                                        @if ($ikuti->status != 'pending')
                                            <form action="{{ route('ikuti.destroy', $ikuti->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="status" value="terima">
                                                <button id="kt_account_deactivate_account_submit" type="submit"
                                                    class="btn btn-danger btn-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('ikuti.update', $ikuti->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="status" value="terima">
                                                <button id="kt_account_deactivate_account_submit" type="submit"
                                                    class="btn btn-primary btn-sm">
                                                    Terima
                                                </button>
                                            </form>
                                            <form action="{{ route('ikuti.update', $ikuti->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="status" value="tolak">
                                                <button id="kt_account_deactivate_account_submit" type="submit"
                                                    class="btn btn-danger btn-sm">
                                                    Tolak
                                                </button>
                                            </form>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">{{ $ikutis->links() }}</td>
                        </tr>
                        @if (!$ikutis->count())
                            Tidak ada permintaan
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
@endsection
