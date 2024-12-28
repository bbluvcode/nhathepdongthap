<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>OTP Email</title>
</head>
<body style="Margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f7f7f7;">

  <!-- Email Container -->
  <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border: 1px solid #dddddd; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
    <tr>
      <td align="center" style="padding: 20px 0; background-color: #007bff; border-top-left-radius: 8px; border-top-right-radius: 8px;">
        <h1 style="color: #ffffff; font-size: 24px; margin: 0;">Xác Minh OTP</h1>
      </td>
    </tr>
    <tr>
      <td style="padding: 20px; color: #333333; font-size: 16px; line-height: 24px;">
        <p style="margin: 0 0 16px;">Xin chào,</p>
        <p style="margin: 0 0 16px;">
          Bạn đã yêu cầu một mã OTP để xác minh tài khoản của mình. Vui lòng sử dụng mã OTP dưới đây để tiếp tục quá trình:
        </p>
        <!-- OTP Code -->
        <p style="font-size: 32px; font-weight: bold; text-align: center; color: #007bff; margin: 20px 0;">
          {{ $OTP }}
        </p>
        <p style="margin: 0 0 16px;">
          Mã này chỉ có hiệu lực trong vòng <strong>5 phút</strong>. Nếu bạn không yêu cầu mã này, vui lòng bỏ qua email này.
        </p>
        <p style="margin: 0 0 16px;">
          Trân trọng,<br>
          <strong>A&C Support</strong>
        </p>
      </td>
    </tr>
    <tr>
      <td align="center" style="padding: 10px; background-color: #f0f0f0; color: #888888; font-size: 12px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
        <p style="margin: 0;">© 2024 Công ty của bạn. Mọi quyền được bảo lưu.</p>
      </td>
    </tr>
  </table>

</body>
</html>
