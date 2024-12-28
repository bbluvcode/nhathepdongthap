@extends('layouts.admin')
@section('title', 'Carausel Page')
<style>
    /* Style cho item đang được kéo */
    .dragging {
        background-color: #d1ecf1;
        /* Màu nền */
        color: #0c5460;
        /* Màu chữ */
        border: 1px dashed #0c5460;
        /* Viền gạch */
    }

    /* Style cho placeholder */
    .sortable-placeholder {
        background-color: #f8f9fa;
        /* Màu nền nhạt */
        border: 2px dashed #adb5bd;
        /* Viền gạch xám */
        height: 50px;
    }

    /* Helper khi kéo */
    .dragging-helper {
        opacity: 0.7;
        /* Làm mờ helper */
        border: 1px solid #6c757d;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .delete-process-link {
        text-decoration: none;
        color: white;

    }

    .delete-badge:hover {
        cursor: pointer;
    }
</style>
@section('content')
    <div class="container p-5">
        <h1 class="text-center bg-primary">QUY TRÌNH TƯ VẤN GIÁM SÁT</h1>
        @if (session('message'))
            <div class="alert alert-info">
                <strong>Info!</strong> {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-center">DANH SÁCH TỪNG HẠNG MỤC</h4>
                <a class="btn btn-primary mt-2 w-25" href="{{ route('admin.post.create') }}">Tạo thêm quy trình</a>
                @if ($processes && $processes->count() > 0)
                    <ul id="sortable-list" class="list-group">
                        @foreach ($processes as $proc)
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                data-id="{{ $proc->id }}"
                                onclick="selectItem({{ $proc->id }}, {{ json_encode($proc->title) }})">
                                <span>{{ $proc->title }}</span>
                                <span class="badge bg-danger delete-badge"><a class="delete-process-link"
                                        href="{{ route('admin.process.deleteProcess', $proc->id) }}">Delete</a></span>
                                <span class="badge bg-primary order-badge">Order {{ $proc->order }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Không có quy trình nào.</p>
                @endif
            </div>
            <div class="col-md-6">
                <form method="POST" action="{{ route('admin.process.store') }}">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" id="itemTitle" name="title" placeholder="nhập title"
                            value="{{ old('title') }}" class="form-control">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btnSubmitProcess">
                        Tạo mới
                    </button>
                    <button type="reset" class="btn btn-warning btnCancelProcess">Cancel </button>
                </form>

                </button>
            </div>
        </div>

        <script>
            // Hàm xử lý khi chọn một item
            function selectItem(id, title) {
                // Điền thông tin vào form để chỉnh sửa
                document.getElementById('itemTitle').value = title;
                document.querySelector(".btnSubmitProcess").textContent = "Cập nhật";
                // Tạo URL cho hành động "Cập nhật"
                var formAction = '{{ route('admin.process.updateProcess', ':id') }}';
                formAction = formAction.replace(':id', id);
                // Cập nhật lại action của form
                document.querySelector('form').action = formAction;
            }
            let btnCancelProcess = document.querySelector(".btnCancelProcess")
            btnCancelProcess.addEventListener("click", () => {
                // Điền thông tin vào form để chỉnh sửa
                document.querySelector(".btnSubmitProcess").textContent = "Tao moi";
                // Tạo URL cho hành động "Cập nhật"
                var formAction = '{{ route('admin.process.store') }}';
                // Cập nhật lại action của form
                document.querySelector('form').action = formAction;
            })
            $(function() {
                // Kích hoạt tính năng sortable với jQuery UI
                $("#sortable-list").sortable({
                    placeholder: "sortable-placeholder", // Hiển thị vùng thả
                    cursor: "move", // Con trỏ di chuyển
                    opacity: 0.7, // Làm mờ item đang kéo
                    helper: function(e, ui) {
                        ui.css("background", "#e9ecef");
                        return ui.clone().addClass("dragging-helper");
                    },
                    start: function(e, ui) {
                        // Thêm class cho item khi bắt đầu kéo
                        ui.item.addClass("dragging");
                    },
                    stop: function(e, ui) {
                        // Xóa class khi dừng kéo
                        ui.item.removeClass("dragging");
                    },
                    update: function(event, ui) {
                        // Khi danh sách thay đổi (khi thả item)
                        let order = [];
                        $("#sortable-list li").each(function(index) {
                            order.push({
                                id: $(this).data("id"), // Lấy ID của item
                                position: index + 1 // Vị trí mới của item
                            });
                        });

                        // Gửi AJAX request để cập nhật thứ tự lên server
                        $.ajax({
                            url: "{{ route('admin.process.updateOrder') }}", // Đảm bảo route đúng
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}", // CSRF token bảo vệ form
                                order: order // Gửi dữ liệu order
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Sau khi thành công, cập nhật lại giao diện với thứ tự mới
                                    console.log("Cập nhật thứ tự thành công");
                                    updateOrderBadge(
                                        order); // Cập nhật lại thứ tự item trong giao diện
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(textStatus, errorThrown);
                                alert("Có lỗi xảy ra khi cập nhật.");
                            }
                        });
                    }
                });
            });

            // Hàm cập nhật lại giá trị order cho badge trong giao diện
            function updateOrderBadge(order) {
                order.forEach(function(item) {
                    // Tìm thẻ badge và cập nhật lại giá trị order
                    var badge = $("li[data-id='" + item.id + "'] .order-badge");
                    badge.text('Order ' + item.position); // Cập nhật giá trị order trong thẻ badge
                });
            }
        </script>


    @endsection
