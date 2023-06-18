@extends('layouts.main')
@section('content')
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Ubah angkatan</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div id="kt_account_settings_profile_details" class="collapse show">
            <!--begin::Form-->
            <form id="kt_account_profile_details_form" class="form" action="{{ route('batches.update', $batch->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="image_old" value="{{ $batch->image }}">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Judul</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title"
                                class="form-control form-control-lg form-control-solid @error('title') is-invalid @enderror"
                                placeholder="judul..." value="{{ $batch->title }}" required autocomplete="off" />
                            <div class="invalid-feedback">
                                @error('title')
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
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Link group</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="link_grup"
                                class="form-control form-control-lg form-control-solid @error('link_grup') is-invalid @enderror"
                                placeholder="link grup..." value="{{ $batch->link_grup }}" required autocomplete="off" />
                            <div class="invalid-feedback">
                                @error('link_grup')
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
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tanggal mulai</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="date" name="start"
                                class="form-control form-control-lg form-control-solid @error('start') is-invalid @enderror"
                                placeholder="link grup..." value="{{ $batch->start }}" required autocomplete="off" />
                            <div class="invalid-feedback">
                                @error('start')
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
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tanggal selesai</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="date" name="end"
                                class="form-control form-control-lg form-control-solid @error('end') is-invalid @enderror"
                                placeholder="link grup..." value="{{ $batch->end }}" required autocomplete="off" />
                            <div class="invalid-feedback">
                                @error('end')
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
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Sampul</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="file" name="image"
                                class="form-control form-control-lg form-control-solid @error('image') is-invalid @enderror"
                                placeholder="sampul..." autocomplete="off" accept=".jpg,.jpeg,.png" />
                            <small class="text-danger">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('batches.index') }}" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Simpan
                        perubahan</button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->
@endsection
