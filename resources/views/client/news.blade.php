@extends('layouts.client')
@section('title', 'Home Page')
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

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card img {
        height: 200px;
        object-fit: cover;
    }

    .card-title {
        color: #2d6a4f;
        /* Màu xanh lá cây đậm */
        font-size: 18px;
        font-weight: bold;
    }

    .card-text {
        font-size: 14px;
        color: #555;
    }

    .advertisement img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
@section('content')
    <div class="container">
        <!-- Header -->
        <div class="title-card mt-1 mb-2">
            <h2 class="title-page">Tin Tức Mới Nhất</h2>
        </div>
        <div class="row">
            <!-- Col-9: Bài viết chính -->
            <div class="col-lg-9">
                @php
                    function slugText($title, $id)
                    {
                        $value = $title . '-' . $id;
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
                <div class="row">
                    @if ($news && $news->count() > 0)
                        @foreach ($news as $item)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{ $item->image }}" alt="Bài viết 1">
                                    <div class="card-body">
                                        <h5 class="card-title text-title">{{ $item->title }}</h5>
                                        <p class="card-text text-description">{{ cleanText($item->description) }}</p>
                                        <a href="{{ route('client.newsDetail', [slugText($item->title, $item->id)]) }}"
                                            class="btn btn-primary btn-sm">Đọc Thêm</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Col-2: Quảng cáo -->
            <div class="col-lg-3">
                <div class="advertisement">
                    @if ($adsNews && $adsNews->count() > 0)
                    @foreach ($adsNews as $item)
                    <img src="{{$item->image}}" alt="Quảng cáo 1">
                    @endforeach
             
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
