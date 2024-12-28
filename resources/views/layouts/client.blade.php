<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhà thép Đồng Tháp</title>
    <link rel="icon" href="/projectImages/logo_nhathep_icon.png" type="image/x-icon" />
    @yield('meta_tags')
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    {{-- <link rel="stylesheet" href="/css/client_header.css"> --}}
    <link rel="stylesheet" href="/css/header.css">

</head>

<body>
    <div class="info-header d-flex justify-content-between gap-5 container-fluid" id="header-top"
        style="display: :none">
        <div class="info-item ms-3">
            <i class="fas fa-envelope"></i>
            @if ($companyInfo)
                <a href="mailto:{{ $companyInfo->email }}">{{ $companyInfo->email }}</a>
            @endif
        </div>
        <div class="info-item">
            Kiến tạo niềm tin, vươn tầm bền vững!
        </div>
        <div class="info-item me-3">
            <i class="fas fa-phone-alt" style="transform: rotate(90deg);"></i>
            @if ($companyInfo)
                <a href="tel:+84{{ $companyInfo->phone }}">+84{{ $companyInfo->phone }}</a>
            @endif
        </div>
    </div>

    <!-- Header with Navbar -->
    <nav class="navbar navbar-expand-lg navbar-brand">
        <div class="container">
            <!-- Logo and Brand -->
            <a class="" href="#">
                @if ($companyInfo)
                    <img src="{{ $companyInfo->logo }}" alt="Logo" width="50" class="me-2 my-1">
                    <p class="company-name">{{ $companyInfo->person }}</p>
                @endif
            </a>
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item {{ $nav_active == 'home' ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('client.home') }}">TRANG CHỦ</a></li>
                    <li class="nav-item {{ $nav_active == 'gioithieu' ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('client.project') }}">GIỚI THIỆU</a></li>
                    <li class="nav-item {{ $nav_active == 'thietke-thicong' ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('client.tvgs') }}">THIẾT KẾ - THI CÔNG</a>
                    </li>
                    <li class="nav-item {{ $nav_active == 'lienhe' ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('client.contact') }}">LIÊN HỆ</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <main>
        @yield('content')
    </main>
    <!-- Button Hotline -->
    @if ($companyInfo)
        <a href="tel:0{{ $companyInfo->phone }}" class="hotline-button">
            Lấy báo giá
            <i class="fas fa-phone-alt"></i>
        </a>
    @endif
    <!-- Footer -->
    <footer class="footer bg-dark text-light mt-5">
        <div class="container py-4">
            <div class="row">
                <!-- Cột 1: Thông tin liên hệ -->
                <div class="col-md-6 mb-3">
                    <h5 class="text-uppercase text-warning">Liên hệ</h5>
                    @if ($companyInfo)
                        <a><i class="bi bi-geo-alt-fill"></i> {{ $companyInfo->address1 }}</a> <br>
                        <a><i class="fas fa-envelope"></i> {{ $companyInfo->address2 }}</a><br>
                        <a><i class="fas fa-phone-alt" style="transform: rotate(90deg);"></i>
                            +84{{ $companyInfo->phone }}</a><br>
                        
                        <a href="mailto:{{ $companyInfo->email }}"
                            style="text-decoration: none; color:white"><i class="fas fa-envelope"></i> {{ $companyInfo->email }}</a>
                    @endif

                </div>
                <!-- Cột 2: Liên kết nhanh -->
                <div class="col-md-6 mb-6">
                    <h5 class="text-uppercase text-warning">Liên kết nhanh</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('client.home') }}">TRANG CHỦ</a></li>
                        <li><a href="{{ route('client.project') }}">GIỚI THIỆU</a></li>
                        <li><a href="{{ route('client.tvgs') }}">THIẾT KẾ - THI CÔNG</a>
                        </li>
                        <li><a href="{{ route('client.contact') }}">LIÊN HỆ</a></li>
                    </ul>
                </div>
                <!-- Cột 3: Theo dõi chúng tôi -->
                <!-- Cột 3: Theo dõi chúng tôi -->
                {{-- <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase text-warning">Theo dõi chúng tôi</h5>
                    <!-- Nhúng Fanpage Facebook -->
                    <iframe
                        src="https://www.facebook.com/plugins/page.php?href={{letchangelinkfb}}&tabs=timeline&width=300&height=300&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true"
                        width="400" height="200" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                </div> --}}

            </div>
            <hr class="bg-light">
            <!-- Bản quyền -->
            <div class="text-center">
                <p class="mb-0">&copy; 2024 Công ty TNHH CƠ KHÍ XD {{ $companyInfo->person }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>

</html>
