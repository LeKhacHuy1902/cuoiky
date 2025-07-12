<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Nhập mã OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .otp-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .otp-input {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            margin: 15px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            letter-spacing: 5px;
        }

        .submit-btn, .resend-btn {
            background: #007bff;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .submit-btn:hover, .resend-btn:hover {
            background: #0056b3;
        }

        .note {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

    </style>
</head>
<body>
    <div class="otp-container">
        <h2>Nhập mã OTP</h2>
        <form action="../models/ProcessOtp.php" method="POST">
            <input type="text" name="otp" class="otp-input" maxlength="6" placeholder="Nhập mã OTP" required>
            <button type="submit" class="submit-btn">Xác nhận</button>
        </form>

        <form action="../models/ProcessResendOtp.php" method="POST">
            <button type="submit" class="resend-btn">Gửi lại mã OTP</button>
        </form>

        <div class="note">
            Vui lòng kiểm tra email hoặc tin nhắn để lấy mã OTP.
        </div>
    </div>
</body>
</html>