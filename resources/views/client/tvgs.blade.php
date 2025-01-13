@extends('layouts.client')
@section('title', 'Thi công - Thiết kế')
@section('meta_tags')
    <meta name="keywords"
        content="nhathepdongthap,nhathep,nhathepmiennam,nhatheptienche, nhaxuong, nhaxuongthep, nhaxuongsat, xây dựng nhà xưởng, nhà xưởng tiền chế, nhà xưởng kèo thép, nhà xưởng thép, giá xây nhà xưởng, gia xay nha xuong, gia xay nha thep, giá xây nhà thép">
    
    <meta name="author" content="NTĐT">
    <meta property="og:description" content="{{ $introtvgs->title }}">
    <!-- Thẻ Open Graph cho chia sẻ trên mạng xã hội -->
    <meta property="og:title" content="{{ $introtvgs->description}}">
    <meta property="og:description" content="{{ $introtvgs->description }}">
    {{-- <meta property="og:image" content="{{ $newsDetail->image }}"> --}}
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
    {{-- <meta property="og:image" content="{{ $introCompany->image }}"> --}}
    <meta property="og:image" content="https://nhathepdongthap.com/projectImages/anhseo.jpg">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
    <!-- Meta Author: Thông tin tác giả hoặc công ty -->
    <meta name="author" content="Nhà thép">
    <!-- Open Graph Image Format for better rendering -->
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="700">
    <meta property="og:image:height" content="500">
@endsection
<style>
    .title-card {
        height: 80px;
        /* Adjust height */
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg,
                #c2e59c,
                #64b3f4);
        border-radius: 10px;
        /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Shadow effect */
        text-align: center;
    }

    .title-page {
        color: #0066cc;
        font-weight: bold;
        text-transform: uppercase;
        text-shadow: 2px 2px 4px rgba(0, 102, 204, 0.3);
    }

    /* General Styling */

    /* Title Styling */
    .title-page-content {
        color: #0066cc;
        font-weight: bold;
        text-transform: uppercase;
        text-shadow: 2px 2px 4px rgba(0, 102, 204, 0.3);
        border-bottom: 4px solid #ff6a00;
        padding-bottom: 10px;
    }

    /* Content Styling */
    .text-content {
        color: #333333;
        line-height: 1.8;
    }

    /* Section Title Styling */
    .section-title {
        color: #0066cc;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 15px;
        position: relative;
        /* Để ::after bám theo .section-title */
        display: inline-block;
        /* Đảm bảo chỉ chiếm không gian vừa với nội dung */
    }

    .section-title::after {
        content: '';
        width: 100%;
        /* Bằng với chiều dài của text */
        height: 3px;
        background: #ff6a00;
        position: absolute;
        left: 0;
        bottom: -5px;
        /* Khoảng cách dưới */
    }

    /* General Styling */
    .banner-card {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        height: 400px;
        background: #f2f2f2;
    }

    /* Hover Effect */
    .banner-card:hover {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
    }

    /* Background Image */
    .banner-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.7);
        transition: transform 0.4s ease, filter 0.4s ease;
    }

    .banner-card:hover .banner-img {
        transform: scale(1.1);
        filter: brightness(0.5);
    }

    /* Overlay */
    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        z-index: 1;
        opacity: 1;
        transition: opacity 0.4s ease;
    }

    /* Content Styling */
    .banner-content {
        text-align: center;
        animation: fadeIn 1s ease forwards;
    }

    .banner-title {
        font-size: 24px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 10px;
        color: #ff6a00;
    }

    .banner-discount {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }

    .banner-discount span {
        font-size: 28px;
        color: #ff9a3f;
    }

    .custom-btn {
        background: linear-gradient(90deg, #71a88e, #FFB200);
        border: none;
        color: white;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 25px;
        transition: background 0.4s ease, transform 0.3s ease;
        box-shadow: 0 4px 10px rgba(255, 106, 0, 0.4);
    }

    .custom-btn:hover {
        background: linear-gradient(90deg, #cc5500, #ff9a3f);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(255, 106, 0, 0.6);
    }

    /* Keyframe Animation */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Activity Card Styling */
    .activity-card {
        height: 200px;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        padding: 0;
        margin: 0;
    }

    .activity-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    .card-img-tvgs {
        height: 150px;
        object-fit: cover;
        transition: transform 0.4s ease, filter 0.4s ease;
        filter: brightness(0.9);
    }

    .activity-card .card-img-top {
        height: 200px;
        object-fit: cover;
        transition: transform 0.4s ease, filter 0.4s ease;
        filter: brightness(0.9);
    }

    .activity-card:hover .card-img-top {
        transform: scale(1.1);
        filter: brightness(1);
    }

    .activity-card .card-title {
        font-size: 18px;
        font-weight: bold;
        color: #0066cc;
    }

    .activity-card .card-text {
        font-size: 14px;
        color: #555;
    }

    .activity-card .btn {
        border-radius: 25px;
        padding: 8px 20px;
        transition: background 0.4s ease, color 0.4s ease;
    }

    .activity-card .btn:hover {
        background-color: #0066cc;
        color: white;
    }

    /* Quote Section Styling */
    .quote-section {
        margin: 30px auto;
        padding: 20px;
        background-color: #e9f7e7;
        /* Xanh lá cây nhạt */
        border-left: 5px solid #ff8c42;
        /* Viền màu cam */
        border-radius: 8px;
        max-width: 800px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .quote-text {
        font-style: italic;
        font-size: 20px;
        color: #2d6a4f;
        /* Xanh lá cây đậm */
        margin: 0 0 10px;
        line-height: 1.6;
    }

    .quote-author {
        font-size: 16px;
        color: #0066cc;
        /* Xanh dương đậm */
        font-weight: bold;
        margin: 0;
    }

    /* Sidebar Section Styling */
    .sidebar-images {
        margin-top: 20px;
    }

    .sidebar-card {
        text-align: center;
        background: #ffffff;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .sidebar-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    /* Image Styling */
    .sidebar-card img {
        border-radius: 10px;
        transition: transform 0.4s ease, filter 0.4s ease;
        filter: brightness(0.9);
    }

    .sidebar-card:hover img {
        transform: scale(1.05);
        filter: brightness(1);
    }

    /* Title Styling */
    .sidebar-title {
        font-size: 16px;
        font-weight: bold;
        color: #0066cc;
        text-transform: uppercase;
        margin: 10px 0 0;
    }

    .text-title {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* number of lines to show */
        line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .text-description {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* number of lines to show */
        line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>
<style>
    <style>
    /* Base Styling (Mobile-first) */
    .title-card {
        height: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #c2e59c, #64b3f4);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .title-page {
        color: #0066cc;
        font-weight: bold;
        text-transform: uppercase;
        text-shadow: 2px 2px 4px rgba(0, 102, 204, 0.3);
    }

    .title-page-content {
        color: #0066cc;
        font-weight: bold;
        text-transform: uppercase;
        text-shadow: 2px 2px 4px rgba(0, 102, 204, 0.3);
        border-bottom: 4px solid #ff6a00;
        padding-bottom: 10px;
    }

    .text-content {
        color: #333333;
        line-height: 1.8;
    }

    .section-title {
        color: #0066cc;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 15px;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        width: 100%;
        height: 3px;
        background: #ff6a00;
        position: absolute;
        left: 0;
        bottom: -5px;
    }

    .banner-card {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        height: 400px;
        background: #f2f2f2;
    }

    .banner-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.7);
        transition: transform 0.4s ease, filter 0.4s ease;
    }

    .banner-card:hover .banner-img {
        transform: scale(1.1);
        filter: brightness(0.5);
    }

    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        z-index: 1;
        opacity: 1;
        transition: opacity 0.4s ease;
    }

    .banner-content {
        text-align: center;
        animation: fadeIn 1s ease forwards;
    }

    .banner-title {
        font-size: 24px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 10px;
        color: #ff6a00;
    }

    .banner-discount {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }

    .custom-btn {
        background: linear-gradient(90deg, #71a88e, #FFB200);
        border: none;
        color: white;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 25px;
        transition: background 0.4s ease, transform 0.3s ease;
        box-shadow: 0 4px 10px rgba(255, 106, 0, 0.4);
    }

    .custom-btn:hover {
        background: linear-gradient(90deg, #cc5500, #ff9a3f);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(255, 106, 0, 0.6);
    }

    /* Mobile-first Keyframe Animation */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .activity-card {
        height: 200px;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .activity-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    .card-img-tvgs {
        height: 150px;
        object-fit: cover;
        transition: transform 0.4s ease, filter 0.4s ease;
        filter: brightness(0.9);
    }

    .activity-card .card-img-top {
        height: 200px;
        object-fit: cover;
        transition: transform 0.4s ease, filter 0.4s ease;
        filter: brightness(0.9);
    }

    .activity-card:hover .card-img-top {
        transform: scale(1.1);
        filter: brightness(1);
    }

    .activity-card .card-title {
        font-size: 18px;
        font-weight: bold;
        color: #0066cc;
    }

    .activity-card .card-text {
        font-size: 14px;
        color: #555;
    }

    .activity-card .btn {
        border-radius: 25px;
        padding: 8px 20px;
        transition: background 0.4s ease, color 0.4s ease;
    }

    .activity-card .btn:hover {
        background-color: #0066cc;
        color: white;
    }

    .quote-section {
        margin: 30px auto;
        padding: 20px;
        background-color: #e9f7e7;
        border-left: 5px solid #ff8c42;
        border-radius: 8px;
        max-width: 800px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .quote-text {
        font-style: italic;
        font-size: 20px;
        color: #2d6a4f;
        margin: 0 0 10px;
        line-height: 1.6;
    }

    .quote-author {
        font-size: 16px;
        color: #0066cc;
        font-weight: bold;
        margin: 0;
    }

    .sidebar-images {
        margin-top: 20px;
    }

    .sidebar-card {
        text-align: center;
        background: #ffffff;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .sidebar-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .sidebar-card img {
        border-radius: 10px;
        transition: transform 0.4s ease, filter 0.4s ease;
        filter: brightness(0.9);
    }

    .sidebar-card:hover img {
        transform: scale(1.05);
        filter: brightness(1);
    }

    .sidebar-title {
        font-size: 16px;
        font-weight: bold;
        color: #0066cc;
        text-transform: uppercase;
        margin: 10px 0 0;
    }

    .text-title {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        line-clamp: 1;
        -webkit-box-orient: vertical;
    }
     .text-description {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    /* Media Queries for Larger Screens */
    @media (min-width: 768px) {
        /* Modify layout for tablets and above */
        .col-lg-3, .col-lg-9 {
            padding-left: 15px;
            padding-right: 15px;
        }

        .banner-card {
            height: 500px;
        }

        .banner-title {
            font-size: 30px;
        }

        .banner-discount {
            font-size: 24px;
        }

        .activity-card .card-title {
            font-size: 20px;
        }

        .activity-card .card-text {
            font-size: 16px;
        }

        .sidebar-title {
            font-size: 18px;
        }
    }

    @media (min-width: 992px) {
        /* Modify layout for desktop and above */
        .col-md-4 {
            max-width: 30%;
        }

        .col-md-6 {
            max-width: 45%;
        }

        .title-page {
            font-size: 30px;
        }

        .activity-card .card-title {
            font-size: 22px;
        }
    }
</style>

</style>
@section('content')
    <div class="container mt-3">
        <div class="container">
            <div class="title-card">
                <h2 class="title-page">Thiết kế Xây dựng Nhà Xưởng</h2>
            </div>
        </div>
        <div class="row mt-2">
            <!-- Main Content: col-9 -->
            <div class="col-lg-12 mt-3">
                @if ($introtvgs)
                    {{-- <h3 class="mb-4 title-page-content">Sứ mệnh</h3> --}}
                    <p class="text-justify fs-5 text-content">{{ $introtvgs->description }}
                    </p>
                @endif


                <h3 class="mt-5 mb-3 section-title">Công trình nhà xưởng</h3>
                {{-- @dd($newsTVSG) --}}
                <div class="row">
                    @php
                        function slugText($title,$id)
                        {
                            $value = $title."-".$id;
                            $slug = Str::slug($value);
                            return $slug;
                        }
                        function cleanText($input)
                        {
                            $decodedText = html_entity_decode($input, ENT_QUOTES, 'UTF-8');
                            $plainText = strip_tags($decodedText);
                            return preg_replace('/[^\p{L}\p{N}\s]/u', '', $plainText);
                        }
                    @endphp
                    <!-- Article Card 1 -->
                    @foreach ($newsTVSG as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card article-card h-100">
                                <img src="{{ $item->image }}" class="card-img-tvgs" alt="{{ $item->title }}">
                                <div class="card-body">
                                    <h5 class="card-title text-title">{{ $item->title }}</h5>
                                    <p class="card-text text-description">{{ cleanText($item->description) }}</p>
                                    <a href="{{ route('client.newsDetail', [slugText($item->title,$item->id)]) }}"
                                        class="btn btn-primary custom-btn">Xem Thêm</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Các Hoạt Động Ấn Tượng -->
                {{-- <div class="row">
                    <h3 class="mt-5 mb-3 section-title">Hoạt Động Ấn Tượng</h3>
                    <div class="row">
                        @if ($newsStandountTVSG)
                            @foreach ($newsStandountTVSG as $item)
                            <div class="col-md-6 mb-4">
                                <div class="card activity-card">
                                    <img src="{{$item->image}}" class="card-img-top"
                                        alt="Hội Thảo Chuyên Đề">
                                    <div class="card-body">
                                        <h5 class="card-title text-title">{{$item->title}}</h5>
                                        <p class="card-text text-description">{{ cleanText($item->description) }}</p>
                                        <a href="{{ route('client.newsDetail', [slugText($item->title,$item->id)]) }}"
                                            class="btn btn-outline-primary">Xem Thêm</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div> --}}
                <!-- Quote Section -->
                @if ($quote)
                <div class="quote-section">
                    <blockquote class="quote-text">
                        "{{$quote->description}}"
                    </blockquote>
                    <p class="quote-author">- {{$quote->author}}</p>
                </div>
                @endif
               
            </div>

            <!-- Sidebar: col-3 Hoạt động giám sát -->
            {{-- <div class="col-lg-3">
                <div style="top: 20px;">
                    <h4 class="mb-3 section-title">Hoạt động giám sát</h4>
                    @if ($specialAds)
                    <div class="card banner-card">
                        <div class="banner-overlay">
                            <div class="banner-content">
                                <h3 class="banner-title">{{$specialAds->title}}</h3>
                                <p class="banner-discount">{{$specialAds->sortDes}}</p>
                                <a href="{{ route('client.price') }}" class="btn btn-primary custom-btn">Xem Ngay</a>
                            </div>
                        </div>
                        <img src="{{$specialAds->image}}" class="card-img banner-img" alt="Quảng Cáo">
                    </div>
                    @endif
                 
                </div>
                <!-- Additional Image Cards -->
                <div class="sidebar-images">
                    @if ($newsStandountTVSG)
                        @foreach ($newsStandountTVSG as $item)
                        <div class="sidebar-card mb-3">
                            <img src="{{$item->image}}" class="img-fluid rounded" alt="Sản phẩm nổi bật">
                            <h5 class="sidebar-title mt-2">{{$item->title}}</h5>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div> --}}
        </div>
    </div>

@endsection
