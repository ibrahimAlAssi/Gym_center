<!DOCTYPE html>
<html>

<head>
  <title>Reset Your Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .email-container {
      width: 80%;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
    }

    .email-header {
      text-align: center;
      padding: 10px;
      background-color: #ff7300;
      color: #ffffff;
    }

    .email-body {
      padding: 20px;
    }

    .email-footer {
      text-align: center;
      padding: 10px;
      background-color: #f4f4f4;
      color: #666666;
    }

    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #ffffff;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div class="email-container">
    <div class="email-header">
      <h2>Reset Your Password</h2>
    </div>
    <div class="email-body">
      <p>Hello,</p>
      <p>
        We received a request to reset your password. If you did not make this request, please ignore this email.
        Otherwise, you can reset your password using the code below:
      </p>
      <p><strong>Your Reset Code:</strong> {{ $code }}</p>
      <p>
        <strong>Note:</strong> This code is valid for 5 minutes only. Please use it within this timeframe to reset your
        password.
      </p>
      <p>If you need further assistance, please contact our support team.</p>
      <p>Thank you,</p>
      <p>GYM</p>
    </div>
  </div>
  <div class="email-footer">
    <p>&copy; {{ date('Y') }} GYM. All rights reserved.</p>
  </div>
</body>

</html>
