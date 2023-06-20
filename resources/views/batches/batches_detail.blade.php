@extends('layouts.main')
@section('content')
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">

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
                <a href="{{ route('batches.index') }}" class="btn btn-sm btn-primary">Kembali</a>
            </div>

            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="/img/batch/{{ $batch->image }}" alt="error" />
                        <div
                            class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                        </div>
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a href="#"
                                    class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $batch->title }}</a>
                                <a href="#"
                                    class="btn btn-sm {{ $batch->status == 'akan datang' ? 'btn-warning' : '' }}{{ $batch->status == 'berlangsung' ? 'btn-success' : '' }}{{ $batch->status == 'selesai' ? 'btn-danger' : '' }} fw-bold ms-2 fs-8 py-1 px-3"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">{{ $batch->status }}</a>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-3 pe-2">
                                <p class="d-flex align-items-center mb-2">
                                    Tanggal mulai : <span class="btn btn-sm btn-light">{{ $batch->start }}</span>
                                </p>
                            </div>
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-3 pe-2">
                                <p class="d-flex align-items-center mb-2">
                                    Tanggal selesai : <span class="btn btn-sm btn-light">{{ $batch->end }}</span>
                                </p>
                            </div>
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-3 pe-2">
                                <p class="d-flex align-items-center mb-2">
                                    <a href="{{ $batch->link_grup }}" class="badge badge-primary text-hover-dark"
                                        target="blank">Bergabung
                                        ke grup</a>
                                </p>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                        <!--begin::Actions-->
                        @can('admin')
                            <div class="d-flex my-4">
                                <a href="{{ route('batches.edit', $batch->id) }}" type="submit"
                                    class="btn btn-sm btn-primary me-2">Ubah batch</a>
                                <form action="{{ route('batches.destroy', $batch->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger me-2">Hapus batch</button>
                                </form>
                            </div>
                        @endcan
                        @can('siswa')
                            @if (!Auth::user()->batch_user->count())
                                <div class="d-flex my-4">
                                    <form action="{{ route('ikuti.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="id_batch" value="{{ $batch->id }}">
                                        <button type="submit" class="btn btn-sm btn-primary me-2">Ikuti angkatan</button>
                                    </form>
                                </div>
                            @endif
                        @endcan
                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
        </div>
    </div>
    <!--end::Navbar-->

    {{-- begin::pelatihan --}}
    <div class="card mb-5 mb-xl-10">
        <div class="card-body p-9">
            @if ($batch->status != 'selesai')
                @can('admin')
                    <div class="mb-3">
                        <a href="{{ route('batches-courses.create', $batch->id) }}" class="btn btn-sm btn-primary">Tambah
                            pelatihan</a>
                    </div>
                @endcan
            @endif
            <div class="row g-5 g-xl-8">
                @if (!$batch->batch_course->count())
                    Tidak ada pelatihan
                @endif
                @foreach ($batch->batch_course as $batch_course)
                    <div class="col-xl-3">
                        <!--begin::Mixed Widget 12-->
                        @if (Auth::user()->role == 'siswa' && $batch->status == 'akan datang')
                            <a href="#" onclick="return alert('Pelatihan belum bisa di akses!')">
                                <div class="card card-xl-stretch mb-xl-8 shadow-sm">
                                    <img src="/img/course/{{ $batch_course->course->image }}" class="card-img-top"
                                        alt="error" style="height: 200px; overflow:hidden">
                                    <div class="card-body text-center text-dark">
                                        <h5 class="card-title">{{ $batch_course->course->title }}</h5>
                                        <small class="badge bg-primary">{{ $batch_course->course->category->name }}</small>
                                        <hr>
                                        <small
                                            class="card-text">{{ $batch_course->course->materi->count() ? $batch_course->course->materi->count() . ' Materi' : 'Tidak ada materi' }}</small>
                                        @can('admin')
                                            <hr>
                                            <form action="{{ route('batches-courses.destroy', $batch_course->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger">Keluarkan</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </a>
                        @else
                            <a
                                href="{{ route('batches-courses-show', $batch_course->course->id) . '?id_batch=' . $batch->id }}">
                                <div class="card card-xl-stretch mb-xl-8 shadow-sm">
                                    <img src="/img/course/{{ $batch_course->course->image }}" class="card-img-top"
                                        alt="error" style="height: 200px; overflow:hidden">
                                    <div class="card-body text-center text-dark">
                                        <h5 class="card-title">{{ $batch_course->course->title }}</h5>
                                        <small class="badge bg-primary">{{ $batch_course->course->category->name }}</small>
                                        <hr>
                                        <small
                                            class="card-text">{{ $batch_course->course->materi->count() ? $batch_course->course->materi->count() . ' Materi' : 'Tidak ada materi' }}</small>
                                        @can('admin')
                                            <hr>
                                            <form action="{{ route('batches-courses.destroy', $batch_course->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger">Keluarkan</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </a>
                        @endif
                        <!--end::Mixed Widget 12-->
                    </div>
                @endforeach
                <!--end::Col-->
            </div>
        </div>
    </div>
    {{-- end::pelatiahn --}}

    {{-- begin::peserta --}}
    <div class="card mb-5 mb-xl-10">
        <div class="card-body p-9">
            @if ($batch->status != 'selesai')
                @can('admin')
                    <div class="mb-3">
                        <a href="{{ route('batches-users.create', $batch->id) }}" class="btn btn-sm btn-primary">Tambah
                            peserta</a>
                    </div>
                @endcan
            @endif

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
                        @if (!$batch->batch_user->count())
                            Tidak ada peserta
                        @endif
                        <tr>
                            <td colspan="3" class="fw-bold text-muted text-light">
                                INSTRUKTUR
                            </td>
                        </tr>
                        @if ($batch->status != 'selesai')
                            @foreach ($batch->batch_user as $peserta)
                                @continue($peserta->user->role == 'siswa')
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <img src="/img/user/{{ $peserta->user->image }}" class=""
                                                    alt="error" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                @if (Auth::user()->role == 'siswa')
                                                    <a class="text-dark fw-bold mb-1 fs-6">{{ $peserta->user->name }}</a>
                                                @else
                                                    <a href="{{ route('user.show', $peserta->user->id) }}/?id_batch={{ $batch->id }}"
                                                        class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $peserta->user->name }}</a>
                                                @endif
                                                <span
                                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $peserta->user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-light-{{ $peserta->user->role === 'instruktur' ? 'info' : '' }}{{ $peserta->user->role === 'siswa' ? 'success' : '' }} fw-semibold me-1">{{ $peserta->user->role }}</span>
                                    </td>
                                    <td class="text-end">
                                        @can('admin')
                                            <form action="{{ route('batches-users.destroy', $peserta->id) }}" method="post"
                                                class="d-inline">
                                                <input type="hidden" name="id_batch" value="{{ $batch->id }}">
                                                <input type="hidden" name="id_user" value="{{ $peserta->user->id }}">
                                                @csrf
                                                @method('delete')
                                                <button id="kt_account_deactivate_account_submit" type="submit"
                                                    class="btn btn-danger btn-sm">
                                                    Keluarkan
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="fw-bold text-muted text-light">
                                    SISWA
                                </td>
                            </tr>
                            @foreach ($batch->batch_user as $peserta)
                                @continue($peserta->user->role == 'instruktur')
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <img src="/img/user/{{ $peserta->user->image }}" class=""
                                                    alt="error" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                @if (Auth::user()->role == 'siswa')
                                                    <a class="text-dark fw-bold mb-1 fs-6">{{ $peserta->user->name }}</a>
                                                @else
                                                    <a href="{{ route('user.show', $peserta->user->id) }}/?id_batch={{ $batch->id }}"
                                                        class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $peserta->user->name }}</a>
                                                @endif
                                                <span
                                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $peserta->user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-light-{{ $peserta->user->role === 'instruktur' ? 'info' : '' }}{{ $peserta->user->role === 'siswa' ? 'success' : '' }} fw-semibold me-1">{{ $peserta->user->role }}</span>
                                    </td>
                                    <td class="text-end">
                                        @can('admin')
                                            <form action="{{ route('batches-users.destroy', $peserta->id) }}" method="post"
                                                class="d-inline">
                                                <input type="hidden" name="id_batch" value="{{ $batch->id }}">
                                                <input type="hidden" name="id_user" value="{{ $peserta->user->id }}">
                                                @csrf
                                                @method('delete')
                                                <button id="kt_account_deactivate_account_submit" type="submit"
                                                    class="btn btn-danger btn-sm">
                                                    Keluarkan
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @if (!$batch->batch_user_history->count())
                                Tidak ada pengguna
                            @endif
                            @foreach ($batch->batch_user_history as $peserta)
                                @continue($peserta->user->role == 'siswa')
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <img src="/img/user/{{ $peserta->user->image }}" class=""
                                                    alt="error" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                @if (Auth::user()->role == 'siswa')
                                                    <a class="text-dark fw-bold mb-1 fs-6">{{ $peserta->user->name }}</a>
                                                @else
                                                    <a href="{{ route('user.show', $peserta->user->id) }}/?id_batch={{ $batch->id }}"
                                                        class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $peserta->user->name }}</a>
                                                @endif
                                                <span
                                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $peserta->user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-light-{{ $peserta->user->role === 'instruktur' ? 'info' : '' }}{{ $peserta->user->role === 'siswa' ? 'success' : '' }} fw-semibold me-1">{{ $peserta->user->role }}</span>
                                    </td>
                                    <td class="text-end">
                                        @if ($batch->status != 'selesai')
                                            @can('admin')
                                                <form action="{{ route('batches-users.destroy', $peserta->id) }}"
                                                    method="post" class="d-inline">
                                                    <input type="hidden" name="id_batch" value="{{ $batch->id }}">
                                                    <input type="hidden" name="id_user" value="{{ $peserta->user->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button id="kt_account_deactivate_account_submit" type="submit"
                                                        class="btn btn-danger btn-sm">
                                                        Keluarkan
                                                    </button>
                                                </form>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="fw-bold text-muted text-light">
                                    SISWA
                                </td>
                            </tr>
                            @foreach ($batch->batch_user_history as $peserta)
                                @continue($peserta->user->role == 'instruktur')
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <img src="/img/user/{{ $peserta->user->image }}" class=""
                                                    alt="error" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                @if (Auth::user()->role == 'siswa')
                                                    <a class="text-dark fw-bold mb-1 fs-6">{{ $peserta->user->name }}</a>
                                                @else
                                                    <a href="{{ route('user.show', $peserta->user->id) }}/?id_batch={{ $batch->id }}"
                                                        class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $peserta->user->name }}</a>
                                                @endif
                                                <span
                                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $peserta->user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-light-{{ $peserta->user->role === 'instruktur' ? 'info' : '' }}{{ $peserta->user->role === 'siswa' ? 'success' : '' }} fw-semibold me-1">{{ $peserta->user->role }}</span>
                                    </td>
                                    <td class="text-end">
                                        @if ($batch->status != 'selesai')
                                            @can('admin')
                                                <form action="{{ route('batches-users.destroy', $peserta->id) }}"
                                                    method="post" class="d-inline">
                                                    <input type="hidden" name="id_batch" value="{{ $batch->id }}">
                                                    <input type="hidden" name="id_user" value="{{ $peserta->user->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button id="kt_account_deactivate_account_submit" type="submit"
                                                        class="btn btn-danger btn-sm">
                                                        Keluarkan
                                                    </button>
                                                </form>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
        </div>
    </div>
    {{-- end::peserta --}}
    </div>
@endsection
