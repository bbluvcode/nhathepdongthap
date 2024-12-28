<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- jQuery và jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- include summernote editor css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: white;
            transition: transform 0.3s ease;
        }

        .sidebar.hide {
            transform: translateX(-250px);
        }

        .sidebar ul {
            padding: 0;
            list-style: none;
            margin-top: 20px;
        }

        .sidebar ul li {
            padding: 15px 20px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
        }

        .sidebar ul li:hover {
            background-color: #495057;
        }

        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        .main-content.shrink {
            margin-left: 0;
        }

        .toggle-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1000;
            background-color: #343a40;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4 class="text-center py-3">Admin Panel</h4>
        <div class="p-2">

            <div class="dropdown mb-2">
                <button type="button" class="btn btn-primary dropdown-toggle w-100 p-2" data-bs-toggle="dropdown">
                    Admin Management
                </button>
                <ul class="dropdown-menu bg-info w-100">
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.carausels.index') }}">Carausel</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.introVideo') }}">Video Intro</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.homeIntro') }}">Intro Home</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.panelJob.index') }}">Panel Job</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.outstanding.index') }}">AC Outstanding</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.feedback.index') }}">Feedback</a></li>
                </ul>
            </div>
            <a class="btn btn-primary w-100 mb-2" href="{{ route('admin.tvgs.index') }}">TVGS</a>
            <a class="btn btn-primary w-100 mb-2" href="{{ route('admin.post.create') }}">POST NEWS</a>
            <a class="btn btn-primary w-100 mb-2" href="{{ route('admin.ads.create') }}">ADS</a>
            <a class="btn btn-primary w-100 mb-2" href="{{ route('admin.price.index') }}">PRICE</a>
            <a class="btn btn-primary w-100 mb-2" href="{{ route('admin.process.index') }}">QUY TRINH TVGS</a>
            <a class="btn btn-primary w-100 mb-2" href="{{ route('admin.project.index') }}">DỰ ÁN</a>
            <a class="btn btn-primary w-100 mb-2" href="{{ route('admin.contact.index') }}">CONTACT</a>
            <a class="btn btn-primary w-100 mb-2" href="{{ route('admin.quote.index') }}">QUOTE</a>
        </div>
    </div>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <main class="main-content" id="main-content">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid d-flex justify-content-end">
                <a class="navbar-brand" href="#">
                    <img src="/images/avatar.png" alt="Logo" style="width:40px;" class="rounded-pill">
                </a>
            </div>
            <div class="dropdown p-2 me-2">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <ul class="dropdown-menu p-2 me-2" style="margin-left: -100px"> <!-- Thêm class ms-3 để dịch chuyển sang trái -->
                    <li><a class="dropdown-item" href="{{route('admin.formChangePass')}}">Change Pass</a></li>
                    <li><a class="dropdown-item" href="{{route('admin.logout')}}">Logout</a></li>
                </ul>
            </div>
        </nav>
        @yield('content')
    </main>
    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleBtn = document.getElementById('toggle-btn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hide');
            mainContent.classList.toggle('shrink');
        });
    </script>

</body>

</html>
