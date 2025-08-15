<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Demo</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 40px 0 20px;
            width: 100%;
            text-align: center;
            box-shadow: 0 -2px 8px #0002;
            margin-top: 80px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }

        .footer-address {
            font-size: 16px;
            font-weight: 500;
        }

        .footer-address i {
            color: #f1c40f;
            margin-right: 8px;
        }

        .footer-social {
            display: flex;
            gap: 16px;
        }

        .footer-social a {
            color: #fff;
            font-size: 18px;
            border: 1px solid #fff;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .footer-social a:hover {
            color: #f1c40f;
            border-color: #f1c40f;
            transform: scale(1.1);
        }

        .footer-copy {
            font-size: 14px;
            margin-top: 12px;
            color: #ccc;
        }

        @media (max-width: 768px) {
            .footer-address {
                text-align: center;
                font-size: 15px;
            }

            .footer-social {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <footer>
        <div class="footer-container">
            <div class="footer-address">
                <i class="fa-solid fa-location-dot"></i>
                Nguyễn Cơ Thạch, P. Cầu Diễn, Q. Nam Từ Liêm, TP. Hà Nội
            </div>
            <div class="footer-social">
                <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="footer-copy">
                &copy; 2025 TechZone. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
