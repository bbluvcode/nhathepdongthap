<!DOCTYPE html>
<html lang="en">

<head>
    <title>OTP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        @if (session('message'))
            <div class="alert alert-info">
                <strong>Info!</strong>{{ session('message') }}
            </div>
        @endif
        <h2>Confirm OTP Code</h2>
        <form action="{{ route('admin.checkOTP') }}" method="POST">
            @csrf
            <div class="mb-3 mt-3">
                <label for="email">OTP CODE:</label>
                <input type="text" class="form-control" placeholder="Enter otp" name="otp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>
