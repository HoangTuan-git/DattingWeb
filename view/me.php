<?php
// filepath: d:\codePTUD\view\me.php
if (!isset($_SESSION['uid'])) {
?>
    <style>
        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
            padding: 2rem 1rem;
            text-align: center;
        }

        .login-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .login-icon svg {
            width: 48px;
            height: 48px;
            fill: white;
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        .login-subtitle {
            font-size: 16px;
            color: #64748b;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .btn-group-custom {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            max-width: 280px;
        }

        .btn-custom {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.4);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.5);
            color: white;
        }

        .btn-secondary-custom {
            background: white;
            color: #667eea;
            border: 2px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
        }

        .btn-secondary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.15);
            border-color: #667eea;
            color: #667eea;
        }

        .btn-icon {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #94a3b8;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            padding: 0 1rem;
        }

        .features {
            margin-top: 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
            width: 100%;
            max-width: 320px;
        }

        .feature {
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 12px;
            text-align: center;
        }

        .feature-icon {
            font-size: 20px;
            margin-bottom: 0.5rem;
        }

        .feature-text {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
        }

        @media (min-width: 768px) {
            .login-container {
                padding: 3rem 2rem;
            }

            .btn-group-custom {
                flex-direction: row;
                max-width: 400px;
            }

            .btn-custom {
                flex: 1;
            }
        }
    </style>

    <div class="login-container">
        <!-- Icon -->
        <div class="login-icon">
            <svg viewBox="0 0 24 24">
                <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm8 8v-1a7 7 0 0 0-14 0v1z" />
            </svg>
        </div>

        <!-- Title & Subtitle -->
        <h2 class="login-title">Chào mừng bạn!</h2>
        <p class="login-subtitle">
            Đăng nhập để khám phá những người tuyệt vời<br>
            và tìm kiếm tình yêu đích thực
        </p>

        <!-- Action Buttons -->
        <div class="btn-group-custom">
            <a href="home.php?page=dangnhap" class="btn-custom btn-primary-custom">
                <svg class="btn-icon" viewBox="0 0 24 24">
                    <path d="M11 7 9.6 8.4l2.6 2.6H2v2h10.2l-2.6 2.6L11 17l5-5-5-5zm9 12h-8v2h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-8v2h8v12z" />
                </svg>
                Đăng nhập
            </a>

            <a href="home.php?page=dangky" class="btn-custom btn-secondary-custom">
                <svg class="btn-icon" viewBox="0 0 24 24">
                    <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm7-2h3v3h-3v-3zm0-3h3v3h-3V9z" />
                </svg>
                Đăng ký
            </a>
        </div>

        <!-- Divider -->
        <div class="divider">
            <span>Tính năng nổi bật</span>
        </div>

        <!-- Features -->
        <div class="features">
            <div class="feature">
                <div class="feature-icon">💖</div>
                <div class="feature-text">Tìm kiếm tình yêu</div>
            </div>
            <div class="feature">
                <div class="feature-icon">🎯</div>
                <div class="feature-text">Gợi ý chính xác</div>
            </div>
            <div class="feature">
                <div class="feature-icon">💬</div>
                <div class="feature-text">Chat an toàn</div>
            </div>
        </div>
    </div>

<?php
} else {
    // Phần đã đăng nhập giữ nguyên...
?>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .profile-section {
            background: #f8f9fa;
            padding: 20px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            text-decoration: none;
            color: #333;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s;
        }

        .menu-item:hover {
            background-color: #f8f9fa;
            color: #333;
        }

        .menu-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 18px;
        }

        .icon-blue {
            background: #e3f2fd;
            color: #1976d2;
        }

        .icon-red {
            background: #ffebee;
            color: #d32f2f;
        }
    </style>

    <?php
    include_once("model/mme.php");
    $p = new mMe();
    $user = $p->GetUserById($_SESSION['uid']);
    $u = $user->fetch_assoc();
    $avartar = $u['avatar'] ?? 'default.png';
    $src = 'img/' .  $avartar;
    ?>
    <div class="container-fluid px-0">
        <!-- Profile Section -->
        <div class="profile-section text-center">
            <div class="mb-3">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                    style="width: 80px; height: 80px; color: white; font-size: 24px; font-weight: bold;">
                    <img src="<?= htmlspecialchars($src ?? 'img/default.png') ?>" alt="Avatar" class="rounded-circle" style="width: 76px; height: 76px; object-fit: cover;">
                </div>
            </div>
            <h5 class="mb-1"><?= htmlspecialchars($_SESSION['email']) ?></h5>
        </div>

        <!-- Menu Items -->
        <div class="menu-list">
            <!-- Ai thích bạn -->
            <a href="home.php?page=xuly" class="menu-item">
                <div class="menu-icon icon-red">
                    <i class="bi bi-heart-fill"></i>
                </div>
                <span>Ai thích bạn</span>
            </a>

            <!-- Đăng xuất -->
            <a href="home.php?page=dangxuat" class="menu-item">
                <div class="menu-icon icon-blue">
                    <i class="bi bi-box-arrow-right"></i>
                </div>
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>
<?php
}
?>