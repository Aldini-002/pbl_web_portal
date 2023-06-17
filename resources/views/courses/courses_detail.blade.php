@extends('layouts.main')
@section('content')
    <div class="card">
        <!--begin::Body-->
        <div class="card-body p-lg-17">

            <div class="mb-3">
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

                        @for ($i = 1; $i < 10; $i++)
                            <!--begin::Section-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                    data-bs-toggle="collapse" data-bs-target="#materi{{ $i }}">
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
                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">MATERI {{ $i }}</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div id="materi{{ $i }}" class="collapse fs-6 ms-1">
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-semibold fs-6">Experience with JavaScript</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-semibold fs-6">Good time-management skills</div>
                                            <!--end::Label-->
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
                            <!--end::Section-->
                        @endfor
                    </div>
                    <!--end::Job-->
                </div>
                <!--end::Content-->


                <!--begin::Sidebar-->
                <div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px">
                    <!--begin::Careers about-->
                    <div class="card bg-light">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Top-->
                            <div class="mb-7">
                                <!--begin::Title-->
                                <h2 class="fs-1 text-gray-800 w-bolder mb-6">About Us</h2>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <p class="fw-semibold fs-6 text-gray-600">First, a disclaimer – the entire process of
                                    writing a blog post often takes more than a couple of hours, even if you can type eighty
                                    words as per minute and your writing skills are sharp.</p>
                                <!--end::Text-->
                            </div>
                            <!--end::Top-->
                            <!--begin::Item-->
                            <div class="mb-8">
                                <!--begin::Title-->
                                <h4 class="text-gray-700 w-bolder mb-0">Requirements</h4>
                                <!--end::Title-->
                                <!--begin::Section-->
                                <div class="my-2">
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-semibold fs-6">Experience with JavaScript</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-semibold fs-6">Good time-management skills</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-semibold fs-6">Experience with React</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-semibold fs-6">Experience with HTML / CSS</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-8">
                                <!--begin::Title-->
                                <h4 class="text-gray-700 w-bolder mb-0">Our Achievements</h4>
                                <!--end::Title-->
                                <!--begin::Section-->
                                <div class="my-2">
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-semibold fs-6">Experience with JavaScript</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-semibold fs-6">Good time-management skills</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-semibold fs-6">Experience with React</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-semibold fs-6">Experience with HTML / CSS</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Link-->
                            <a href="../../demo1/dist/pages/blog/post.html" class="link-primary fs-6 fw-semibold">Explore
                                More</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Careers about-->
                </div>
                <!--end::Sidebar-->

            </div>
            <!--end::Layout-->
        </div>
        <!--end::Body-->
    </div>
@endsection
