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
        background-color: gainsboro !important;

    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card img {
        border-bottom: 3px solid #ff8c42;
        height: 200px;
        width: 100%;
        object-fit: contain;
        padding-bottom: 10px;
        padding-top: 10px;
        border-radius:10px; 
    }

    .card-body {
        background-color: #e9f7e7;
        /* Xanh lá cây nhạt */
        padding: 15px;
        color: #333;
    }

    .card-title {
        font-size: 20px;
        font-weight: bold;
        color: #2d6a4f;
        /* Xanh lá cây đậm */
    }

    .card-text {
        font-size: 14px;
        margin-bottom: 8px;
    }

    .card-footer {
        background-color: #ffecd0;
        /* Cam nhạt */
        color: #333;
        font-weight: bold;
        padding: 10px 15px;
        text-align: center;
    }

    .project-grid {
        margin: 20px 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

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
</style>
@section('content')
    {{-- @dd($projects) --}}
    <div class="container project-grid">
        <div class="title-card mt-1 mb-2">
            <h2 class="title-page">DỰ ÁN TIÊU BIỂU</h2>
        </div>
        <div class="row g-4">
            @foreach ($projects as $item)
                     <!-- Card 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <img src="{{$item->image}}" class="image-project img-fluid" alt="Dự án 1">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->title}}</h5>
                        <p class="card-text">Loại công trình: {{$item->type}}</p>
                        <p class="card-text">Diện tích: {{$item->area}} m²</p>
                        <p class="card-text">Chủ đầu tư: {{$item->owner}}</p>
                    </div>
                    <div class="card-footer">Hoàn thành: {{$item->year}}</div>
                </div>
            </div>
            @endforeach
        </div>
        @if ($quote)
        <div class="quote-section">
            <blockquote class="quote-text">
                "{{$quote->description}}"
            </blockquote>
            <p class="quote-author">- {{$quote->author}}</p>
        </div>
        @endif
    </div>


@endsection
