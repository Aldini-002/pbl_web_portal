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

            <div class="mb-3">
                <a href="{{ route('batches.show', $batch->id) }}" class="btn btn-sm btn-primary">Kembali</a>
            </div>

            <form action="{{ route('batches-users.create', $batch->id) }}" class="d-inline mb-3">
                <div class="row mb-6">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="fv-row mb-0">
                            <input type="text" name="name" value="{{ request('name') }}"
                                class="form-control bg-transparent" placeholder="nama...">
                        </div>
                    </div>
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="fv-row mb-0">
                            <select name="role" class="form-select" data-control="select2" data-hide-search="true">
                                <option {{ !request('role') ? 'selected disabled' : '' }} value="">
                                    {{ request('role') ? 'Kosongkan' : 'role...' }}</option>
                                <option value="siswa" {{ request('role') === 'siswa' ? 'selected' : '' }}>Siswa
                                </option>
                                <option value="instruktur" {{ request('role') === 'instruktur' ? 'selected' : '' }}>
                                    Instruktur</option>
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

            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bold text-muted text-light bg-dark">
                            <th class="ps-4 min-w-325px rounded-start">Profile</th>
                            <th class="ps-4 min-w-325px ">Role</th>
                            <th class="min-w-200px text-end rounded-end"></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($users as $user)
                            @continue($user->batch_user->count())
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-5">
                                            <img src="/img/user/{{ $user->image }}" class="" alt="error" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="{{ route('user.show', $user->id) }}"
                                                class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $user->name }}</a>
                                            <span
                                                class="text-muted fw-semibold text-muted d-block fs-7">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="badge badge-light-{{ $user->role === 'instruktur' ? 'info' : '' }}{{ $user->role === 'siswa' ? 'success' : '' }} fw-semibold me-1">{{ $user->role }}</span>
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('batches-users.store') }}" method="post" class="d-inline">
                                        <input type="hidden" name="id_batch" value="{{ $batch->id }}">
                                        <input type="hidden" name="id_user" value="{{ $user->id }}">
                                        @csrf
                                        <button id="kt_account_deactivate_account_submit" type="submit"
                                            class="btn btn-primary btn-sm">
                                            Tambahkan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">{{ $users->links() }}</td>
                        </tr>
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
