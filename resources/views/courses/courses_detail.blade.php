@extends('layouts.main')
@section('content')
    <div class="card">
        <!--begin::Body-->
        <div class="card-body p-lg-17">

            <div class="mb-3">
                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Ubah pelatihan</a>
                <form action="{{ route('courses.destroy', $course->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus pelatihan</button>
                </form>
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

            <!--begin::Hero-->
            <div class="position-relative mb-8">
                <!--begin::Overlay-->
                <div class="overlay overlay-show">
                    <!--begin::Image-->
                    <img src="/img/course/{{ $course->image }}" alt="error"
                        class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded" style="height: 250px">
                    <!--end::Image-->
                </div>
                <!--end::Overlay-->
            </div>
            <!--end::-->
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row mb-17">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-0 me-lg-20">
                    <!--begin::Job-->
                    <div class="mb-17">
                        <!--begin::Description-->
                        <div class="m-0">
                            <!--begin::Title-->
                            <h4 class="fs-1 text-gray-800 w-bolder mb-6">{{ $course->title }}</h4>
                            <!--end::Title-->
                            <p class="fw-bold">Kategori : <a
                                    href="{{ route('courses.index', 'id_category=' . $course->category->id) }}"
                                    class="badge bg-primary">{{ $course->category->name }}</a></p>
                            <!--begin::Text-->
                            <p class="fw-semibold fs-4 text-gray-600 mb-2">{!! $course->description !!}</p>
                            <!--end::Text-->
                        </div>
                        <!--end::Description-->

                        <hr>

                        <!--begin::Accordion-->
                        <!--begin::Section-->
                        <p class="fw-semibold fs-4 text-gray-600 mb-2">MATERI</p>

                        <!--begin::Section-->
                        @foreach ($materis as $materi)
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                    data-bs-toggle="collapse" data-bs-target="#materi{{ $loop->iteration }}">
                                    <!--begin::Icon-->
                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                        <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20"
                                                    height="20" rx="5" fill="currentColor" />
                                                <rect x="6.0104" y="10.9247" width="12" height="2"
                                                    rx="1" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                        <span class="svg-icon toggle-off svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20"
                                                    height="20" rx="5" fill="currentColor" />
                                                <rect x="10.8891" y="17.8033" width="12" height="2"
                                                    rx="1" transform="rotate(-90 10.8891 17.8033)"
                                                    fill="currentColor" />
                                                <rect x="6.01041" y="10.9247" width="12" height="2"
                                                    rx="1" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">MATERI {{ $loop->iteration }}
                                    </h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div id="materi{{ $loop->iteration }}" class="collapse fs-6 ms-1">
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            @if ($materi->type == 'pdf')
                                                <a href="/doc/materi/{{ $materi->materi }}" class="fw-semibold fs-6"
                                                    target="blank">{{ $materi->title }}</a>
                                            @else
                                                <a href="{{ $materi->materi }}" class="fw-semibold fs-6"
                                                    target="blank">{{ $materi->title }}</a>
                                            @endif
                                            <!--end::Label-->

                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#ubah_materi{{ $materi->id }}">Ubah</button>
                                            <form action="{{ route('materis.destroy', $materi->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>

                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed"></div>
                                <!--end::Separator-->
                            </div>
                        @endforeach
                        <!--end::Section-->

                        {{-- begin::tambah materi --}}
                        <div class="mt-5">
                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse"
                                data-bs-target="#tambah_materi" aria-expanded="false">
                                Tambah materi pdf
                            </button>
                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse"
                                data-bs-target="#tambah_materi_yt" aria-expanded="false">
                                Tambah materi youtube
                            </button>
                            <div class="collapse" id="tambah_materi">
                                <div class="my-5">
                                    <form action="{{ route('materis.store') }}" class="d-inline" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_course" value="{{ $course->id }}">
                                        <input type="hidden" name="type" value="pdf">
                                        <div class="row">
                                            <div class="col-lg-5 mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <input type="text" name="title" value="{{ old('title') }}"
                                                        class="form-control bg-transparent @error('title') is-invalid @enderror"
                                                        placeholder="judul materi..." required autocomplete="off"
                                                        value="{{ old('title') }}">
                                                    <div class="invalid-feedback">
                                                        @error('title')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <input type="file" name="materi" value="{{ old('materi') }}"
                                                        class="form-control bg-transparent @error('materi') is-invalid @enderror"
                                                        placeholder="file" required accept=".pdf">
                                                    <div class="invalid-feedback">
                                                        @error('materi')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <button type="submit" class="btn btn-primary"
                                                        style="width: 100%">Tambah
                                                        materi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="collapse" id="tambah_materi_yt">
                                <div class="my-5">
                                    <form action="{{ route('materis.store') }}" class="d-inline" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_course" value="{{ $course->id }}">
                                        <input type="hidden" name="type" value="youtube">
                                        <div class="row">
                                            <div class="col-lg-5 mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <input type="text" name="title" value="{{ old('title') }}"
                                                        class="form-control bg-transparent @error('title') is-invalid @enderror"
                                                        placeholder="judul materi..." required autocomplete="off"
                                                        value="{{ old('title') }}">
                                                    <div class="invalid-feedback">
                                                        @error('title')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <input type="text" name="materi" value="{{ old('materi') }}"
                                                        class="form-control bg-transparent @error('materi') is-invalid @enderror"
                                                        placeholder="judul materi..." required autocomplete="off"
                                                        value="{{ old('materi') }}">
                                                    <div class="invalid-feedback">
                                                        @error('materi')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <button type="submit" class="btn btn-primary"
                                                        style="width: 100%">Tambah
                                                        materi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- end::tambah materi --}}

                    </div>
                    <!--end::Job-->
                </div>
                <!--end::Content-->

            </div>
            <!--end::Layout-->
        </div>
        <!--end::Body-->
    </div>

    <!--begin::Modal - Ubah email-->
    <!-- Modal -->
    @foreach ($materis as $materi)
        <div class="modal fade" id="ubah_materi{{ $materi->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <!--begin::Form-->
                        <form class="form" action="{{ route('materis.update', $materi->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="materi_old" value="{{ $materi->materi }}">
                            <div class="row mb-6">
                                <div class="col-lg-6 mb-4 mb-lg-0">
                                    <div class="fv-row mb-0">
                                        <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Judul
                                            materi</label>
                                        <input type="text"
                                            class="form-control form-control-lg form-control-solid @error('title') is-invalid @enderror"
                                            placeholder="judul materi..." name="title" value="{{ $materi->title }}"
                                            required autocomplete="off" />
                                        <div class="invalid-feedback">
                                            @error('title')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="fv-row mb-0">
                                        <label for="confirmemailpassword"
                                            class="form-label fs-6 fw-bold mb-3">Materi</label>
                                        <input type="file"
                                            class="form-control form-control-lg form-control-solid @error('materi') is-invalid @enderror"
                                            name="materi" accept=".pdf" />
                                        <div class="invalid-feedback">
                                            @error('materi')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!--end::Modal - Ubah email-->
@endsection
