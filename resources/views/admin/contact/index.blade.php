@extends('layouts.admin')
@section('title', 'Carausel Page')
<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .profile-card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        background-color: #FCFFC1;
        padding: 20px;
        text-align: center;
    }

    .profile-img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin-bottom: 15px;
        border: 4px solid #007bff;
    }

    .icon-text {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 8px 0;
    }

    .icon-text i {
        margin-right: 10px;
        color: #007bff;
    }

    /* Custom CSS for hidden row */
    .tooltip-row {
        display: none;
        background-color: #f8f9fa;
    }

    .tooltip-row td {
        padding: 10px;
        font-style: italic;
        color: #333;
    }
</style>

@section('content')
    <div class="container mt-3">
        @if (!empty($success))
            <div class="alert alert-success">
                <strong>Success!</strong>{{ $success }}
            </div>
        @endif
        @if ($contact)
            <div class="row justify-content-center">
                <!-- Company Profile -->
                <div class="col-md-8 mb-4">
                    <div class="profile-card">
                        <img src="{{ $contact->logo }}" alt="Company Logo" class="profile-img">
                        <h3 class="mb-3">CÔNG TY TNHH CƠ KHÍ XÂY DỰNG NHÀ THÉP ĐỒNG THÁP</h3>
                        <div class="icon-text">
                            <i class="fa-solid fa-user"></i>
                            <span>{{ $contact->person }}</span>
                        </div>
                        <div class="icon-text">
                            <i class="fas fa-envelope"></i>
                            <span>{{ $contact->email }}</span>
                        </div>
                        <div class="icon-text">
                            <i class="fas fa-phone"></i>
                            <span>{{ $contact->phone }}</span>
                        </div>
                        <div class="icon-text">
                            <i class="fas fa-map-marker-alt"></i>
                            <span> {{ $contact->address1 }}</span>
                        </div>
                        <div class="icon-text">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $contact->address2 }}</span>
                        </div>
                    </div>
                </div>
                <a class="btn btn-info w-50" href="{{ route('admin.contact.edit', $contact->id) }}">Cập nhật thông tin</a>
            </div>
        @endif
        <div class="row p-5">
            @if (session("message"))
            <div class="alert alert-info">
                <strong>Info!</strong> {{session("message")}}
              </div>
            @endif
            @if ($messages)
                <h3 class="text-center badge rounded-pill bg-primary p-3">THÔNG TIN LIÊN HỆ KHÁCH HÀNG</h3>
                <table class="table table-bordered table-hover align-middle knowtable">
                    <thead>
                        <tr class="table-primary">
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $item)
                            <!-- Main row -->
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <!-- Message column -->
                                <td>
                                    <span class="message-tooltip" data-id="{{ $item->id }}">
                                        {{ Str::limit($item->message, 20) }} <!-- Cắt ngắn nội dung -->
                                        <i class="fa-solid fa-info-circle text-primary"></i>
                                    </span>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="{{ route('admin.message.delete', $item->id) }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Hidden row for full message -->
                            <tr class="tooltip-row" id="tooltip-row-{{ $item->id }}">
                                <td colspan="6">
                                    <strong>Full Message:</strong> {{ $item->message }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tooltips = document.querySelectorAll('.message-tooltip');

            tooltips.forEach(function(tooltip) {
                tooltip.addEventListener('mouseenter', function() {
                    const id = this.getAttribute('data-id');
                    const row = document.getElementById(`tooltip-row-${id}`);
                    row.style.display = 'table-row'; // Hiển thị dòng ẩn
                });

                tooltip.addEventListener('mouseleave', function() {
                    const id = this.getAttribute('data-id');
                    const row = document.getElementById(`tooltip-row-${id}`);
                    row.style.display = 'none'; // Ẩn dòng khi rời chuột
                });
            });
        });
    </script>
@endsection
