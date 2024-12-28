<!doctype html>
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Báo Giá Tư Vấn Giám Sát</title>

    <!-- Styles -->
    <style>
        /* Font và reset mặc định */
        * {
            font-family: DejaVu Sans, sans-serif !important;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            line-height: 1.6;
            color: #333;
            font-size: 14px;
        }

        .container-price {
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 120px;
            height: auto;
        }

        .company-info {
            text-align: center;
            margin: 10px 0;
        }

        h1,
        h2 {
            margin: 5px 0;
            color: #000;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container-price">
        <!-- Header -->
        <div class="header">
            @if ($contact)
                <img src="{{ public_path($contact->logo) }}" alt="Logo Công Ty">
            @endif

            <h1>Công Ty TNHH TƯ VẤN GIÁM SÁT XÂY DỰNG A&C</h1>
            <h2>Báo Giá Tư Vấn Giám Sát</h2>
        </div>

        <!-- Thông tin công ty -->
        <div class="company-info">
            @if ($contact)
                <p>Địa chỉ: {{ $contact->address1 }}</p>
                <p>Điện thoại: {{ $contact->phone }} | Email: {{ $contact->email }}</p>
            @endif
            <p>Ngày: {{ now()->format('d/m/Y') }}</p>
        </div>

        <!-- Table -->
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
                @foreach ($prices as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->package }}</td>
                        <td>{{ $item->timew }}</td>
                        <td>{{ $item->timed }}</td>
                        <td>{{ number_format($item->cost) }} triệu</td>
                        <td>{{ $item->note }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>{!! $notePrice->desNote !!}</p>
        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Công Ty TNHH TƯ VẤN GIÁM SÁT XÂY DỰNG A&C. Tất cả các quyền được bảo lưu.</p>
        </div>
    </div>
</body>

</html>
