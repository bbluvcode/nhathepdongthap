@extends('layouts.client')
@section('title', 'Home Page')
<style>
    .contact-container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        padding: 10px;
    }

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

    .contact-image {
        /* Cam nhạt */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        border-radius: 0 10px 10px 0;
        height: 400px;
    }

    .contact-image img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        /* Bo góc cho hình ảnh */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        /* Hiệu ứng đổ bóng */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Hiệu ứng hover mượt */
    }

    .contact-image img:hover {
        transform: scale(1.01);
        /* Phóng to nhẹ khi hover */
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        /* Tăng độ sâu của bóng khi hover */
    }

    .contact-form {
        padding: 30px;
    }

    .form-label {
        font-weight: bold;
        color: #2d6a4f;
        /* Xanh lá cây đậm */
    }

    .form-control {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #2d6a4f;
        /* Đổi viền khi focus */
        box-shadow: 0 0 5px rgba(45, 106, 79, 0.5);
    }

    .contact-info h5 {
        font-weight: bold;
        color: #2d6a4f;
    }

    .contact-info p {
        margin: 5px 0;
        color: #555;
    }

    .contact-info i {
        color: #ff8c42;
        margin-right: 8px;
    }
</style>
@section('content')
    <div class="container mt-2">
        <div class="contact-container">
            <div class="row">
                <!-- Col-8: Thông tin liên hệ và form -->
                <div class="col-lg-8">
                    <!-- Header -->
                    <div class="title-card">
                        <h2 class="title-page"> THÔNG TIN LIÊN HỆ</h2>
                    </div>

                    <!-- Thông tin liên hệ -->
                    <div class="contact-form">
                        <div class="contact-info mb-4">
                            <h5>Thông Tin Liên Hệ</h5>
                            @if ($contact)
                                <p><i class="bi bi-geo-alt"></i> Địa chỉ: {{ $contact->address1 }}</p>
                                <p><i class="bi bi-telephone"></i> Điện thoại: {{ $contact->phone }}</p>
                                <p><i class="bi bi-envelope"></i> Email: {{ $contact->email }}</p>
                            @endif
                        </div>
                        @if (session('message'))
                            <div class="alert alert-info">
                                <strong>Info!</strong> {{ session('message') }}
                            </div>
                        @endif
                        <!-- Form gửi thông tin -->
                        <form action="{{ route('client.contact.message') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và Tên</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nhập họ và tên của bạn">
                                @error('name')
                                    <p class="text-center">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="Nhập email của bạn">
                                @error('email')
                                    <p class="text-center">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="phone" class="form-control" id="phone" placeholder="Nhập phone của bạn"
                                    name="phone">
                                @error('phone')
                                    <p class="text-center">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Lời nhắn</label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Nhập lời nhắn của bạn"></textarea>
                                @error('message')
                                    <p class="text-center">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success w-100">Gửi Thông Tin</button>
                        </form>
                    </div>
                </div>

                <!-- Col-4: Hình ảnh đại diện -->
                <div class="col-lg-4 contact-image">
                    <img src="https://www.shutterstock.com/image-vector/office-operator-headset-talking-clients-600nw-2171955089.jpg"
                        alt="Hình ảnh liên hệ">
                </div>
            </div>
        </div>
    </div>

@endsection
