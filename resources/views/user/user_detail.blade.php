@extends('layouts.main')
@section('content')
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">

            <div class="mb-3">
                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">Kembali</a>
            </div>

            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="/img/user/{{ $user->image }}" alt="error" />
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
                                    class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $user->name }}</a>
                                <a href="#" class="btn btn-sm btn-light-success fw-bold ms-2 fs-8 py-1 px-3"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">{{ $user->role }}</a>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                    {{ $user->email }}
                                </a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                        <!--begin::Actions-->
                        <div class="d-flex my-4">
                            <form action="{{ route('user.update', $user->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="role" value="admin">
                                <button type="submit" class="btn btn-sm btn-success me-2"
                                    style="display: {{ $user->role === 'admin' ? 'none' : '' }}"
                                    onclick="return confirm('Jadikan admin!')">Jadikan admin</button>
                            </form>
                            <form action="{{ route('user.update', $user->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="role" value="instruktur">
                                <button type="submit" class="btn btn-sm btn-primary me-2"
                                    style="display: {{ $user->role === 'instruktur' ? 'none' : '' }}"onclick="return confirm('Jadikan instruktur!')">Jadikan
                                    instruktur</button>
                            </form>
                            <form action="{{ route('user.update', $user->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="role" value="siswa">
                                <button type="submit" class="btn btn-sm btn-light me-2"
                                    style="display: {{ $user->role === 'siswa' ? 'none' : '' }}"onclick="return confirm('Jadikan siswa!')">Jadikan
                                    siswa</button>
                            </form>
                        </div>
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


    <div class="card mb-5 mb-xl-10">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="true"
                    style="border-radius: 0">Profile</button>
                <button class="nav-link" id="nav-angkatan-tab" data-bs-toggle="tab" data-bs-target="#nav-angkatan"
                    type="button" role="tab" aria-controls="nav-angkatan" aria-selected="false"
                    style="border-radius: 0">Angkatan</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            {{-- begin::profile --}}
            <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                tabindex="0">

                <!--begin::Basic info-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form class="form" action="{{ route('me.update', $user->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <!--begin::Card body-->
                        <div class="card-body p-9">
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

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true"
                                        style="background-image: url('/metronic/media/svg/avatars/blank.svg')">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url(/img/user/{{ $user->image }})"></div>
                                        <!--end::Preview existing avatar-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">Tipe yang di izinkan: png, jpg, jpeg.</div>
                                    <small class="text-danger">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama lengkap</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <input type="text" name="name"
                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('name') is-invalid @enderror"
                                        placeholder="Nama lengkap..." value="{{ $user->name }}" autocomplete="off"
                                        readonly />
                                    <div class="invalid-feedback">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">Nomor telepon</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Phone number must be active"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="tel" name="telepon"
                                        class="form-control form-control-lg form-control-solid @error('telepon') is-invalid @enderror"
                                        placeholder="Nomor telepon" value="{{ $user->telepon }}" autocomplete="off"
                                        readonly />
                                    <div class="invalid-feedback">
                                        @error('telepon')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">Nomor Induk Keluarga</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="nik"
                                        class="form-control form-control-lg form-control-solid @error('nik') is-invalid @enderror"
                                        placeholder="Nomor Induk Keluarga..." value="{{ $user->nik }}"
                                        autocomplete="off" readonly />
                                    <div class="invalid-feedback">
                                        @error('nik')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
                <!--end::Basic info-->


                <!--begin::Sign-in Method-->
                <!--begin::Content-->
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <!--begin::Email Address-->
                        <div class="d-flex flex-wrap align-items-center">
                            <!--begin::Label-->
                            <div id="kt_signin_email">
                                <div class="fs-6 fw-bold mb-1">Alamat email</div>
                                <div class="fw-semibold text-gray-600">{{ $user->email }}</div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Email Address-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-6"></div>
                        <!--end::Separator-->

                        <!--begin::Password-->
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <!--begin::Label-->
                            <div id="kt_signin_password">
                                <div class="fs-6 fw-bold mb-1">Password</div>
                                <div class="fw-semibold text-gray-600">************</div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Password-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Content-->
                <!--end::Sign-in Method-->


                <!--begin::Deactivate Account-->
                <!--begin::Content-->
                <div id="kt_account_settings_deactivate" class="collapse show">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Notice-->
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                        rx="10" fill="currentColor" />
                                    <rect x="11" y="14" width="7" height="2" rx="1"
                                        transform="rotate(-90 11 14)" fill="currentColor" />
                                    <rect x="11" y="17" width="2" height="2" rx="1"
                                        transform="rotate(-90 11 17)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1">
                                <!--begin::Content-->
                                <div class="fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">Anda akan menghapus akun anda</h4>
                                    <div class="fs-6 text-gray-700">Akun anda akan dihapus secara permanen dari
                                        database!
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->
                        <!--begin::Card footer-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button id="kt_account_deactivate_account_submit" type="submit"
                                    class="btn btn-danger fw-semibold"
                                    onclick="return confirm('Akun akan dihapus secara permanen!\nlanjutkan')">Hapus
                                    akun</button>
                            </form>
                        </div>
                        <!--end::Card footer-->
                    </div>
                </div>
                <!--end::Content-->
                <!--end::Deactivate Account-->
                {{-- end::profile --}}

            </div>
            {{-- end::profile --}}

            {{-- begin:: --}}
            <div class="tab-pane fade" id="nav-angkatan" role="tabpanel" aria-labelledby="nav-angkatan-tab"
                tabindex="0">
                ...
            </div>
            {{-- end:: --}}
        </div>
    </div>
@endsection
