<!DOCTYPE html>
<html>
<head>
  <title>Customer Support Confirmation</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f4f4f4;">
    <tr>
      <td align="center" style="padding: 20px 0;">
        <!-- Main Container -->
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
          <!-- Header -->
          <tr>
            <td align="center" style="background-color: #007bff; color: #ffffff; padding: 20px; font-size: 24px; font-weight: bold;">
              XÁC NHẬN THÔNG TIN
            </td>
          </tr>
          <!-- Body -->
          <tr>
            <td style="padding: 30px; font-size: 16px; color: #333333; line-height: 1.5;">
              <p style="margin: 0 0 10px;">Chào <strong>{{$data["name"]}}</strong>,</p>
              <p style="margin: 0 0 15px;">
                Chúng tôi đã nhận được yêu cầu hỗ trợ của bạn. Bộ phận chăm sóc khách hàng sẽ sớm liên hệ với bạn trong thời gian sớm nhất.
              </p>
              <p style="margin: 0 0 10px;"><strong>Thông tin bạn đã gửi:</strong></p>
              <ul style="margin: 0 0 15px; padding-left: 20px;">
                <li><strong>Tên:</strong> {{$data["name"]}}</li>
                <li><strong>Số điện thoại:</strong> {{$data["phone"]}}</li>
                <li><strong>Lời nhắn:</strong> {{$data["message"]}}</li>
              </ul>
              <p style="margin: 0 0 10px;">Cảm ơn bạn đã liên hệ với chúng tôi!</p>
            </td>
          </tr>
          <!-- Footer -->
          <tr>
            <td align="center" style="background-color: #f4f4f4; color: #777777; padding: 20px; font-size: 12px;">
              <p style="margin: 0;">Công ty TVGS A&C | Hotline: 123-456-789 | Email: support@example.com</p>
              <p style="margin: 0;">&copy; 2024 A&C Company. All rights reserved.</p>
            </td>
          </tr>
        </table>
        <!-- End Main Container -->
      </td>
    </tr>
  </table>
</body>
</html>
