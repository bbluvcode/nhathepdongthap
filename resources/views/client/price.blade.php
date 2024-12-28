@extends('layouts.client')
@section('title', 'Home Page')
<style>
    /* Nội dung chính */
    .main-content {
        background-color: #e9f7e7;
        /* Xanh lá cây nhạt */
        border-radius: 10px;
        padding: 20px;
    }

    /* Sidebar quảng cáo */
    .sidebar {
        background-color: #ffe8d6;
        /* Cam nhạt */
        border-radius: 10px;
        padding: 20px;
    }

    /* Tiêu đề chính */
    .header-price-title{
        color: #2d6a4f;
        /* Xanh đậm */
        font-weight: bold;
    }

    /* Container cho table cuộn ngang */
    .table-container {
        overflow-x: auto;
        /* Cho phép cuộn ngang */
        -webkit-overflow-scrolling: touch;
        /* Cuộn mượt trên mobile */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        min-width: 700px;
        /* Ngăn bảng co quá nhỏ trên mobile */
    }

    table th,
    table td {
        border: 1px solid #000;
        text-align: center;
        padding: 8px;
    }

    table th {
        background-color: #f2f2f2;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Hiệu ứng scroll bar (tuỳ chọn) */
    .table-container::-webkit-scrollbar {
        height: 8px;
    }

    .table-container::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 4px;
    }

    /* Media query cho mobile */
    @media (max-width: 768px) {

        table th,
        table td {
            font-size: 14px;
            /* Giảm cỡ chữ cho mobile */
            padding: 6px;
            /* Giảm padding */
        }
    }

    /* Bài viết quy trình */
    .articles-section {
        margin-top: 30px;
        padding: 20px;
        border: 1px solid #2d6a4f;
        border-radius: 10px;
        background: linear-gradient(145deg, #f1fdf4, #e0f7eb);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .articles-section h3 {
        color: #2d6a4f;
        font-weight: bold;
        font-size: 24px;
        border-bottom: 2px solid #2d6a4f;
        padding-bottom: 8px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .articles-section ul {
        list-style-type: none;
        padding: 0;
    }

    .articles-section ul li {
        margin-bottom: 15px;
        background-color: #f8f9fa;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        color: #2d6a4f;
        position: relative;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .articles-section ul li::before {
        content: "✓";
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #52b788;
        font-size: 18px;
    }

    .articles-section ul li:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        background-color: #e9f7e7;
    }

    /* Quy trình */
    .process-section {
        padding: 20px 0;
        background-color: #e9f7e7;
        border-radius: 10px;
    }

    /* Căn giữa hàng quy trình */
    .process-section .row {
        display: flex;
        justify-content: center;
        /* Căn giữa các bước */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        overflow-x: auto; 
    }

    /* Các bước quy trình */
    .step-item {
        text-align: center;
        margin: 15px;
        /* Khoảng cách giữa các bước */
        max-width: 200px;
        /* Giới hạn chiều rộng cho mỗi bước */
    }

    .step-icon {
        font-size: 40px;
        color: #007bff;
        /* Màu biểu tượng */
        margin-bottom: 10px;
    }

    .step-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }

    .step-desc {
        font-size: 14px;
        color: #555;
    }
    .step-item {
    margin: 10px 0; /* Khoảng cách giữa các bước */
    flex: 0 0 auto; /* Đảm bảo kích thước không thay đổi */
}

.arrow-container {
    display: flex;
    align-items: center;
    justify-content: center;
}
    @media (min-width: 992px) {
        .d-none.d-lg-flex {
            display: flex !important;
        }

    }
</style>

@section('content')
    <div class="container my-4">
        <div class="row">
            <!-- Nội dung chính -->
            <div class="col-lg-9 col-md-8">
                <div class="main-content">
                    <h2 class="header-price-title">Báo Giá Tư Vấn Giám Sát</h2>
                    <!-- Table Container -->
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Gói dịch vụ</th>
                                    <th>Thời gian giám sát</th>
                                    <th>Thời gian (h)/ngày</th>
                                    <th>Chi phí / tháng</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->package }}</td>
                                        <td>{{ $item->timew }}</td>
                                        <td>{{ $item->timed }}</td>
                                        <td>{{ intval($item->cost) }} triệu</td>
                                        <td>{{ $item->note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p>{!! $notePrice->desNote !!}</p>
                    <a href="{{ route('download.price') }}" class="btn btn-primary">Tải báo giá</a>
                </div>

                <!-- Bài viết quy trình -->
                <div class="articles-section">
                    <h3>Quy Trình Giám Sát Xây Dựng</h3>
                    <ul>
                        @if ($processes && $processes->count() > 0)
                            @foreach ($processes as $item)
                                <li>{{ $item->title }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Sidebar quảng cáo -->
            <div class="col-lg-3 col-md-4">
                <div class="sidebar">
                    <h4 class="text-center">Hoạt Động TVGS</h4>
                    <div class="mt-3">
                        @if ($priceAds && $priceAds->count() > 0)
                            @foreach ($priceAds as $item)
                                <img src="{{ $item->image }}" class="img-fluid rounded mb-3" alt="Ad 1">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quy trình các bước -->
        <div class="row mt-3">
            <div class="process-section">
                <div class="row text-center align-items-center flex-lg-nowrap flex-wrap">
                    <!-- Step 1 -->
                    <div class="col-lg-2 col-md-6 step-item">
                        <div class="step-icon"><i class="fa-regular fa-handshake"></i></div>
                        <h5 class="step-title">Trao Đổi Tư Vấn</h5>
                        <p class="step-desc">Trao đổi yêu cầu và tư vấn định hướng ý tưởng.</p>
                    </div>
                    <div class="col-lg-1 d-none d-lg-flex arrow-container">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    <!-- Step 2 -->
                    <div class="col-lg-2 col-md-6 step-item">
                        <div class="step-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                        <h5 class="step-title">Báo Giá</h5>
                        <p class="step-desc">Gửi báo giá và quy trình cụ thể.</p>
                    </div>
                    <div class="col-lg-1 d-none d-lg-flex arrow-container">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    <!-- Step 3 -->
                    <div class="col-lg-2 col-md-6 step-item">
                        <div class="step-icon"><i class="fa-solid fa-lightbulb"></i></div>
                        <h5 class="step-title">Triển Khai</h5>
                        <p class="step-desc">Bắt đầu triển khai dự án theo yêu cầu.</p>
                    </div>
                    <div class="col-lg-1 d-none d-lg-flex arrow-container">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    <!-- Step 4 -->
                    <div class="col-lg-2 col-md-6 step-item">
                        <div class="step-icon"><i class="fa-solid fa-check-circle"></i></div>
                        <h5 class="step-title">Hoàn Thành</h5>
                        <p class="step-desc">Bàn giao sản phẩm và hỗ trợ sau triển khai.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
