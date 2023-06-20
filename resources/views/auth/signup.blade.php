@extends('layouts.auth')
@section('content')
    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
        <!--begin::Wrapper-->
        <div class="w-lg-500px p-10">
            <!--begin::Form-->
            <form class="form w-100" action="{{ route('auth.store') }} " method="post" enctype="multipart/form-data">
                @csrf
                <!--begin::Heading-->
                <div class="text-center mb-11">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
                    <!--end::Title-->
                    <!--begin::Subtitle-->
                    <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>
                    <!--end::Subtitle=-->
                </div>
                <!--begin::Heading-->
                <!--begin::Login options-->
                <div class="row g-3 mb-9">
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <!--begin::Google link=-->
                        <a href="#"
                            class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                            <img alt="Logo" src="/metronic/media/svg/brand-logos/google-icon.svg"
                                class="h-15px me-3" />Sign in with Google</a>
                        <!--end::Google link=-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <!--begin::Google link=-->
                        <a href="#"
                            class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                            <img alt="Logo" src="/metronic/media/svg/brand-logos/apple-black.svg"
                                class="theme-light-show h-15px me-3" />
                            <img alt="Logo" src="/metronic/media/svg/brand-logos/apple-black-dark.svg"
                                class="theme-dark-show h-15px me-3" />Sign in with Apple</a>
                        <!--end::Google link=-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Login options-->
                <!--begin::Separator-->
                <div class="separator separator-content my-14">
                    <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                </div>
                <!--end::Separator-->

                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="text" placeholder="Nama lengkap..." name="name" autocomplete="off"
                        class="form-control bg-transparent @error('name') is-invalid @enderror" required
                        value="{{ old('name') }}" />
                    <div class="invalid-feedback">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                    <!--end::Email-->
                </div>
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="email" placeholder="Alamat email..." name="email" autocomplete="off"
                        class="form-control bg-transparent @error('email') is-invalid @enderror" required
                        value="{{ old('email') }}" />
                    <div class="invalid-feedback">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                    <!--end::Email-->
                </div>
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::age-->
                    <input type="number" placeholder="Umur..." name="age" autocomplete="off"
                        class="form-control bg-transparent @error('age') is-invalid @enderror" required
                        value="{{ old('age') }}" />
                    <div class="invalid-feedback">
                        @error('age')
                            {{ $message }}
                        @enderror
                    </div>
                    <!--end::age-->
                </div>
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::age-->
                    <input type="tel" placeholder="Nomor telepon..." name="telepon" autocomplete="off"
                        class="form-control bg-transparent @error('telepon') is-invalid @enderror" required
                        value="{{ old('telepon') }}" />
                    <div class="invalid-feedback">
                        @error('telepon')
                            {{ $message }}
                        @enderror
                    </div>
                    <!--end::age-->
                </div>
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::school-->
                    <select name="school_level" class="form-select bg-transparent" data-control="select2"
                        data-hide-search="true" required>
                        <option selected disabled>Pendidikan
                            terakhir/saat ini...</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="SMK">SMK</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Sarjana">Sarjana</option>
                        <option value="Magister">Magister
                        </option>
                        <option value="Doktor">Doktor</option>
                    </select>
                    <div class="invalid-feedback">
                        @error('school_level')
                            {{ $message }}
                        @enderror
                    </div>
                    <!--end::school-->
                </div>


                <!--begin::Input group-->
                <div class="fv-row mb-8" data-kt-password-meter="true">
                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input class="form-control bg-transparent @error('password') is-invalid @enderror"
                                type="password" placeholder="Kata sandi..." name="password" autocomplete="off" required />
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>
                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                            <div class="invalid-feedback">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <!--end::Input wrapper-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Hint-->
                    <div class="text-muted">Gunakan 6 karakter atau lebih.</div>
                    <!--end::Hint-->
                </div>
                <!--end::Input group=-->
                <!--end::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Repeat Password-->
                    <input placeholder="Konfirmasi kata sandi..." name="confPassword" type="password" autocomplete="off"
                        class="form-control bg-transparent @error('confPassword') is-invalid @enderror" required />
                    <div class="invalid-feedback">
                        @error('confPassword')
                            {{ $message }}
                        @enderror
                    </div>
                    <!--end::Repeat Password-->
                </div>
                <!--end::Input group=-->
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                    <input type="file" placeholder="Foto profil..." name="image" autocomplete="off"
                        class="form-control bg-transparent @error('image') is-invalid @enderror" required
                        accept=".png,.jpeg,.jpg" />
                    <div class="invalid-feedback">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </div>
                    <!--end::Email-->
                </div>
                <!--begin::Input group=-->

                <!--begin::Submit button-->
                <div class="d-grid mb-10">
                    <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">Sign up</span>
                        <!--end::Indicator label-->
                    </button>
                </div>
                <!--end::Submit button-->
                <!--begin::Sign up-->
                <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                    <a href="{{ route('auth.signin') }}" class="link-primary fw-semibold">Sign in</a>
                </div>
                <!--end::Sign up-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
@endsection
