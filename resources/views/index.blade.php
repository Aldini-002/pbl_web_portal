@extends('layouts.second')
@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <section class="section main-banner" id="top" data-section="section1">
        <video autoplay muted loop id="bg-video">
            <source src="/edu/images/course-video.mp4" type="video/mp4" />
        </video>
        <div class="video-overlay header-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="caption">
                            <h2>Selamat Datang di AyoKerjo</h2>
                            <p>Ayo Kerjo adalah situs web sebagai sarana penerapan Work Readiness program <a rel="nofollow"
                                    href="https://disnakerwonogiri.id/" target="_blank">Disnaker</a> bagi Calon Pencari
                                Kerja. Situs web ini akan membantu Calon Pencari Kerja untuk mengupgrade skill kesiapan
                                kerja dengan materi Work Readiness yang telah disiapkan <a rel="nofollow"
                                    href="https://disnakerwonogiri.id/" target="_blank">Tim WRP Disnaker</a>.</p>
                            <div class="main-button-red">
                                <div class="scroll-to-section">
                                    <!--begin::Icon-->
                                    <img src="/metronic/media/svg/brand-logos/d3ti.png" class="h-100px w-100px"
                                        alt="" />
                                    </a>
                                    <!--end::Icon-->

                                    <!--begin::Icon-->
                                    <img src="/metronic/media/svg/brand-logos/sv.png" class="h-100px w-100px"
                                        alt="" />
                                    </a>
                                    <!--end::Icon-->

                                    <!--begin::Icon-->
                                    <img src="/metronic/media/svg/brand-logos/uns.png" class="h-100px w-100px"
                                        alt="" />
                                    </a>
                                    <!--end::Icon-->
                                </div>
                            </div>
                            @guest
                                <div class="main-button-red">
                                    <div class=""><a href="{{ route('auth.signin') }}">Bergabung !</a></div>
                                </div>
                            @else
                                <div class="main-button-red">
                                    <div class=""><a href="{{ route('dashboard') }}">Bergabung !</a></div>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
    </section>
    <!-- ***** Main Banner Area End ***** -->

    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-service-item owl-carousel">
                        <div class="item">
                            <div class="icon">
                                <img src="/edu/images/service-icon-01.png" alt="">
                            </div>
                            <div class="down-content">
                                <h4>Pelatihan Terbaik</h4>
                                <p>Terdapat berbagai macam pelatihan yang sesuai dengan minat dan bakat.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="icon">
                                <img src="/edu/images/service-icon-02.png" alt="">
                            </div>
                            <div class="down-content">
                                <h4>Instruktur Berpengalaman</h4>
                                <p>Intruktur yang mempunyai wawasan dan pengalaman yang banyak.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="icon">
                                <img src="/edu/images/service-icon-03.png" alt="">
                            </div>
                            <div class="down-content">
                                <h4>Kerja sama Mitra</h4>
                                <p>Banyak menjalin kerja sama dengan berbagai mitra.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="icon">
                                <img src="/edu/images/service-icon-02.png" alt="">
                            </div>
                            <div class="down-content">
                                <h4>Sertifikat Kompetensi</h4>
                                <p>Mendapatkan sertifikat yang terjamin akan kredibilitas kerjanya.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="icon">
                                <img src="/edu/images/service-icon-03.png" alt="">
                            </div>
                            <div class="down-content">
                                <h4>Kerja sama Mitra</h4>
                                <p>Banyak menjalin kerja sama dengan berbagai mitra.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="upcoming-meetings" id="meetings" style="background-image: url(/edu/images/meetings-bg.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- begin Judul Lowongan Pekerjaan -->
                    <div class="section-heading">
                        <span>Lowongan Kerja
                            <span class="position-relative d-inline-block text-danger  text-left">
                                <a href="https://account.kemnaker.go.id/auth/login"
                                    class="text-danger opacity-75-hover">SIAPKerja</a>
                                <!--begin::Separator-->
                                <span
                                    class="position-absolute opacity-15 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                                <!--end::Separator-->
                            </span>
                            <div class="fs-2hx fw-bold text-gray-800 text-right mb-13">
                                <a href="https://account.kemnaker.go.id/auth/login"
                                    class=" text-danger opacity-75-hover fs-6 fw-semibold">Lihat selengkapnya</a>
                            </div>
                        </span>
                    </div>
                    <!-- end Judul Lowongan Pekerjaan -->
                </div>
                <!-- Begin Lowongan Pekerjaan -->
                <div class="row g-5 g-xl-8 .col-lg-">
                    @foreach ($siapkerjas as $siapkerja)
                        <div class="col-xl-3">
                            <div class="cardi cardi-s-stretch mb-xl-2">
                                <div class="cardi-body">
                                    <div class="d-flex flex-center w-100">
                                        <div style="height: 400px">
                                            <img src="{{ $siapkerja['job']['employer']['logo_uri'] }}"
                                                class="cardi-img-top border rounded" alt="error" style="height:200px">
                                        </div>
                                    </div>
                                    <div class="text-left w-100 position-relative z-index-1" style="margin-top: -130px">
                                        <h5 class="fw-bold text-black-800 m-0">{{ $siapkerja['job']['employer']['name'] }}
                                        </h5>
                                        <div class="text-left w-100 position-relative z-index-1" style="margin-top: 20px">
                                            <h6 class="fw-semibold text-grey-600 m-0">{{ $siapkerja['job']['title'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardi-footer d-flex flex-center py-2">
                                    <div class="d-flex align-items-center flex-shrink-0 me-7 me-lg-12">
                                        <img src="/metronic/media/icons/group.png" class="h-15px w-15px my-5"
                                            alt="" /> &nbsp;
                                        <span class="fw-bold text-black-400 fs-8">{{ $siapkerja['quota'] }} Lowongan</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-shrink-0">
                                        <img src="/metronic/media/icons/clock.png" class="h-15px w-15px my-5"
                                            alt="" /> &nbsp;
                                        <span class="fw-bold text-black-400 fs-8">
                                            <span class="fw-bold text-black-400 fs-8">
                                                {{ \Carbon\Carbon::parse($siapkerja['updated_at'])->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="cardi-footer d-flex flex-center py-2">
                                    <div class="d-flex flex-stack">
                                        <a href="https://account.kemnaker.go.id/auth/login"
                                            class="fw-bold">selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section class="upcoming-meetings" id="meetings" style="background-image: url(/edu/images/apply-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- begin Judul Lowongan Pekerjaan -->
                    @if (Auth::check())
                        @if (Auth::user()->role != 'Admin')
                            <div class="section-heading">
                                <span class="position-relative d-inline-block text-danger  text-left">
                                    <a href="{{ route('batches.index') }}"
                                        class="text-danger opacity-75-hover">Angkatan</a>
                                    <!--begin::Separator-->
                                    <span
                                        class="position-absolute opacity-15 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                                    <!--end::Separator-->
                                </span>
                                <span>Untuk Anda</span>
                                <div class="fs-2hx fw-bold text-gray-800 text-right mb-13">
                                </div>
                                </span>
                            </div>
                        @endif
                    @endif
                    <!-- end Judul Lowongan Pekerjaan -->
                </div>
                @guest
                    <section class="apply-now" id="apply">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 align-self-center">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="item">
                                                <h3>WORK READINESS</h3>
                                                <p>Work Readiness merupakan pelatihan yang disediakan oleh Dinas Tenaga Kerja
                                                    Kabupaten Wonogiri supaya menciptakan tenaga kerja yang berkualitas.</p>
                                                <div class="main-button-red"><a href="{{ route('batches.index') }}">LIHAT
                                                        WORK READINESS</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="item">
                                                <h3>LOWONGAN KERJA</h3>
                                                <p>Dinas Tenaga Kerja Kabupaten Wonogiri menyediakan banyak lowongan pekerjaan
                                                    yang dapat dilamar oleh para pencari kerja.</p>
                                                <div class="main-button-yellow">
                                                    <div class="scroll-to-section"><a
                                                            href="https://account.kemnaker.go.id/auth/login">LIHAT LOWONGAN
                                                            KERJA</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="accordions is-first-expanded">
                                        <article class="accordion">
                                            <div class="accordion-head">
                                                <span>Tentang AyoKerjo</span>
                                                <span class="icon">
                                                    <i class="icon fa fa-chevron-right"></i>
                                                </span>
                                            </div>
                                            <div class="accordion-body">
                                                <div class="content">
                                                    <p>AyoKerjo merupakan website milik Dinas Tenaga Kerja Kabupaten Wonogiri
                                                        yang menyediakan beberapa pelatihan bagi para pencari kerja. </p>
                                                </div>
                                            </div>
                                        </article>
                                        <article class="accordion">
                                            <div class="accordion-head">
                                                <span>Tentang Work Readiness</span>
                                                <span class="icon">
                                                    <i class="icon fa fa-chevron-right"></i>
                                                </span>
                                            </div>
                                            <div class="accordion-body">
                                                <div class="content">
                                                    <p>Work Readiness merupakan pelatihan resmi yang disediakan oleh Dinas
                                                        Tenaga Kerja Kabupaten Wonogiri. Anda akan mendapatkan sertifikat yang
                                                        dikeluarkan oleh DInas Tenaga
                                                        Kerja Kabupaten Wonogiri</p>
                                                </div>
                                            </div>
                                        </article>
                                        <article class="accordion">
                                            <div class="accordion-head">
                                                <span>Tentang Lowongan Kerja</span>
                                                <span class="icon">
                                                    <i class="icon fa fa-chevron-right"></i>
                                                </span>
                                            </div>
                                            <div class="accordion-body">
                                                <div class="content">
                                                    <p>Lowongan Kerja yang dikeluarkan dari situs resmi dapat anda daftar di
                                                        AyoKerjo. Anda dapat melampirkan
                                                        sertifikat pelatihan saat melamar pekerjaan.</p>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endguest

                <!-- Begin Batch -->
                <div class="row g-5 g-xl-8 .col-lg-">
                    @if (Auth::check())
                        @if (Auth::user()->role != 'Admin')
                            <div id="kt_app_content" class="app-content flex-column-fluid">
                                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                                    @foreach ($batches_diikutis as $batch)
                                        @continue($batch->batch->status == 'selesai')
                                        <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 mb-md-3 mb-xl-3">
                                            <div class="cardi mb-3 p-2" style="width: 100%;">
                                                <img src="/img/batch/{{ $batch->batch->image }}"
                                                    class="cardi-img-top border rounded" alt="error"
                                                    style="height:200px">
                                                <div class="cardi-body">
                                                    <div class="cardi-text fs-6">{{ $batch->batch->title }}</div>
                                                    <div>
                                                        <img src="/metronic/media/icons/group.png"
                                                            class="h-15px w-15px my-5" alt="" /> &nbsp;
                                                        {{ $batch->batch->batch_user->count() ? $batch->batch->batch_user->count() . ' Peserta' : 'Belum ada peserta' }}
                                                    </div>
                                                    <div>
                                                        <img src="/metronic/media/icons/training-course.png"
                                                            class="h-15px w-15px my-5" alt="" /> &nbsp;
                                                        {{ $batch->batch->batch_course->count() ? $batch->batch->batch_course->count() . ' Pelatihan' : 'Belum ada pelatihan' }}
                                                    </div>
                                                    <div>
                                                        <img src="/metronic/media/icons/soon.png"
                                                            class="h-15px w-15px my-5" alt="" /> &nbsp;
                                                        {{ $batch->batch->status }}
                                                    </div>
                                                    <div>
                                                        <img src="/metronic/media/icons/calendar.png"
                                                            class="h-15px w-15px my-5" alt="" /> &nbsp;
                                                        {{ $batch->batch->start }} s/d
                                                        {{ $batch->batch->end }}
                                                    </div>
                                                    <hr>
                                                    <a href="{{ route('batches.show', $batch->batch->id) }}"
                                                        class="fw-bold">selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
