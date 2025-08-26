<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing Mobile</title>
    <style>
        :root {
            --bg: #0b1220;
            --accent: #ff4458;
            --accent-dark: #e33749;
            --white: #fff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            /* chặn tràn ngang */
        }

        body {
            font-family: system-ui, -apple-system, Roboto, sans-serif;
            background: var(--bg);
            color: var(--white);
            display: flex;
            flex-direction: column;
        }

        /* Màn hình chính */
        .screen {
            width: 100%;
            /* luôn full theo màn hình */
            max-width: 100%;
            /* không vượt quá */
            min-height: 100vh;
            padding: 8px 16px 0;
            position: relative;
            overflow: hidden;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            position: relative;
            z-index: 10;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 700;
            font-size: 14px;
        }

        .logo .dot {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            background: linear-gradient(135deg, #ff6a7a, #ff4458);
        }

        .actions {
            display: flex;
            gap: 6px;
        }

        .actions button,
        .actions a {
            font-size: 12px;
            font-weight: 600;
            border-radius: 20px;
            padding: 4px 10px;
            border: none;
            cursor: pointer;
        }

        .btn-lang {
            background: transparent;
            color: #fff;
            border: 1px solid #444;
        }

        .btn-login {
            background: #fff;
            color: #111;
            text-decoration: none;
        }

        /* HERO */
        .hero {
            height: calc(100vh - 60px);
            /* trừ đi header */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 10px;
            z-index: 10;
            position: relative;
        }

        .hero h1 {
            font-size: 8vw;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .btn-primary {
            display: inline-block;
            background: var(--accent);
            color: #fff;
            padding: 12px 20px;
            border-radius: 999px;
            font-size: 4vw;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 6px 16px rgba(255, 68, 88, .4);
        }

        .btn-secondary {
            display: inline-block;
            margin-top: 12px;
            color: #fff;
            padding: 12px 20px;
            font-size: 2vw;
            font-weight: 700;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="screen">
        <!-- HEADER -->
        <header class="header">
            <div class="logo">
                <span class="dot"></span>
                <span>tinder</span>
            </div>
            <div class="actions">
                <button class="btn-lang">Chính sách</button>
                <a href="view/dangnhap.php" class="btn-login">Đăng nhập</a>
            </div>
        </header>

        <!-- HERO -->
        <section class="hero">
            <h1>Kết Nối Bốn Phương</h1>
            <a href="view/dangky.php" class="btn-primary">Tạo tài khoản</a>
            <a href="home.php" class="btn-secondary">Tôi muốn dùng thử</a>
        </section>
    </div>

</body>

</html>