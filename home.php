<?php
session_start();
ob_start();

// Lấy trang hiện tại (mặc định: home)
$page = $_GET['page'] ?? 'home';

// Tiêu đề hiển thị
$titles = [
  'home'       => 'Trang chủ',
  'timkiem'    => 'Tìm kiếm',
  'dexuat'     => 'Đề xuất',
  'xuly'       => 'Người thích bạn',
  'tinnhan'    => 'Tin nhắn',
  'me'         => 'Tôi',
  'dangky'     => 'Đăng ký',
  'dangnhap'   => 'Đăng nhập',
  'dangxuat'   => 'Đăng xuất'
];

// Icon cho từng trang
$icons = [
  'home'       => '<path d="M12 3 3 10v11h6v-6h6v6h6V10z" />',
  'timkiem'    => '<path d="M10 2a8 8 0 1 1-5.29 13.71l-4 4a1 1 0 0 1-1.42-1.42l4-4A8 8 0 0 1 10 2Zm0 2a6 6 0 1 0 0 12a6 6 0 0 0 0-12Z" />',
  'dexuat'     => '<path d="M5 3l2 4 4 2-4 2-2 4-2-4-4-2 4-2 2-4Zm11 2l1.5 3 3 1.5-3 1.5L16 14l-1.5-3L11 8.5 14.5 7 16 5Zm-2 9l2 4 4 2-4 2-2 4-2-4-4-2 4-2 2-4Z" />',
  'xuly'       => '<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>',
  'tinnhan'    => '<path d="M4 4h16v12H7l-3 3V4z" />',
  'me'         => '<path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm8 8v-1a7 7 0 0 0-14 0v1z" />',
  'dangky'     => '<path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm7-2h3v3h-3v-3zm0-3h3v3h-3V9z"/>',
  'dangnhap'   => '<path d="M11 7 9.6 8.4l2.6 2.6H2v2h10.2l-2.6 2.6L11 17l5-5-5-5zm9 12h-8v2h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-8v2h8v12z"/>',
  'dangxuat'   => '<path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.59L17 17l5-5zM4 5h8V3H4a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>'
];
?>
<!doctype html>
<html lang="vi">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title><?= htmlspecialchars($titles[$page] ?? 'Trang') ?></title>
  <style>
    :root {
      --bg-main: #f8fafc;
      --bg-nav: #ffffff;
      --text: #475569;
      --text-active: #6d28d9;
      --shadow: 0 -8px 24px rgba(15, 23, 42, .08);
      --border: #cbd5e1;
      --fab: #7c3aed;
      --header-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    * {
      box-sizing: border-box
    }

    body {
      margin: 0;
      min-height: 100svh;
      font-family: system-ui, Arial, sans-serif;
      background: var(--bg-main);
      color: #0f172a;
      padding-bottom: 100px;
    }

    /* HEADER STYLES */
    .header {
      background: var(--header-gradient);
      color: white;
      padding: max(20px, env(safe-area-inset-top, 0px)) 16px 24px;
      position: relative;
      overflow: hidden;
    }

    .header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="white" opacity="0.1"/><circle cx="80" cy="40" r="0.5" fill="white" opacity="0.1"/><circle cx="40" cy="80" r="1.5" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
      pointer-events: none;
    }

    .header-content {
      position: relative;
      z-index: 2;
      max-width: 480px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .header-icon {
      width: 32px;
      height: 32px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .header-icon svg {
      width: 20px;
      height: 20px;
      fill: currentColor;
    }

    .header-title {
      flex: 1;
    }

    .header-title h1 {
      margin: 0;
      font-size: 24px;
      font-weight: 700;
      letter-spacing: -0.025em;
    }

    .header-title .subtitle {
      margin: 0;
      font-size: 14px;
      opacity: 0.8;
      font-weight: 400;
    }

    .header-actions {
      display: flex;
      gap: 8px;
    }

    .header-btn {
      width: 40px;
      height: 40px;
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      color: white;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .header-btn:hover {
      background: rgba(255, 255, 255, 0.25);
      transform: translateY(-1px);
    }

    .header-btn svg {
      width: 18px;
      height: 18px;
      fill: currentColor;
    }

    /* MAIN CONTENT */
    .screen {
      max-width: 480px;
      margin: 0 auto;
      padding: 16px;
    }

    /* BOTTOM NAV */
    .bottom-nav {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 0;
      margin-inline: auto;
      max-width: 480px;
      background: var(--bg-nav);
      border-top: 2px solid var(--border);
      border-radius: 16px 16px 0 0;
      box-shadow: var(--shadow);
      padding: 8px 8px calc(8px + env(safe-area-inset-bottom, 0px));
      z-index: 30;
    }

    .tabs {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      align-items: center;
      gap: 4px;
    }

    .tab {
      text-decoration: none;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 4px;
      padding: 6px 4px;
      color: var(--text);
      border-radius: 12px;
      transition: all 0.2s ease;
    }

    .tab:hover {
      background: rgba(109, 40, 217, 0.1);
    }

    .tab[aria-selected="true"] {
      color: var(--text-active);
      font-weight: 600;
      background: rgba(109, 40, 217, 0.1);
    }

    .tab svg {
      width: 24px;
      height: 24px;
    }

    .label {
      font-size: 11px;
    }

    .card {
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 16px;
      box-shadow: 0 4px 12px rgba(15, 23, 42, .06);
      margin: 12px 0;
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
      .header-content {
        padding: 0 4px;
      }

      .header-title h1 {
        font-size: 20px;
      }
    }
  </style>
</head>

<body>

  <!-- Header -->
  <header class="header">
    <div class="header-content">
      <div class="header-icon">
        <svg viewBox="0 0 24 24">
          <?= $icons[$page] ?? $icons['home'] ?>
        </svg>
      </div>

      <div class="header-title">
        <h1><?= htmlspecialchars($titles[$page] ?? 'Trang') ?></h1>
        <?php if (isset($_SESSION['uid'])): ?>
          <p class="subtitle">Chào mừng trở lại!</p>
        <?php endif; ?>
      </div>

      <div class="header-actions">
        <?php if (isset($_SESSION['uid']) && $page !== 'me'): ?>
          <!-- Nút thông báo -->
          <a href="home.php?page=xuly" class="header-btn" title="Thông báo">
            <svg viewBox="0 0 24 24">
              <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z" />
            </svg>
          </a>

          <!-- Nút profile -->
          <a href="home.php?page=me" class="header-btn" title="Tài khoản">
            <svg viewBox="0 0 24 24">
              <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm8 8v-1a7 7 0 0 0-14 0v1z" />
            </svg>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- MAIN -->
  <main class="screen">
    <?php
    switch ($page) {
      case 'dexuat':
        include_once 'view/dexuat.php';
        break;
      case 'timkiem':
        include_once 'view/timkiem.php';
        break;
      case 'tinnhan':
        include_once 'view/tinnhan.php';
        break;
      case 'me':
        include_once 'view/me.php';
        break;
      case 'dangky':
        include_once 'view/dangky.php';
        break;
      case 'dangnhap':
        include_once 'view/dangnhap.php';
        break;
      case 'dangxuat':
        include_once 'view/dangxuat.php';
        break;
      case 'xuly':
        include_once 'view/xuly.php';
        break;
      case 'bantin':
      default:
        include_once 'view/bantin.php';
        break;
    }
    ?>
  </main>

  <!-- Bottom Navigation -->
  <nav class="bottom-nav" role="tablist">
    <div class="tabs">
      <a class="tab" href="home.php" aria-selected="<?= $page === 'home' ? 'true' : 'false' ?>">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 3 3 10v11h6v-6h6v6h6V10z" />
        </svg>
        <span class="label">Trang chủ</span>
      </a>
      <a class="tab" href="home.php?page=timkiem" aria-selected="<?= $page === 'timkiem' ? 'true' : 'false' ?>">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M10 2a8 8 0 1 1-5.29 13.71l-4 4a1 1 0 0 1-1.42-1.42l4-4A8 8 0 0 1 10 2Zm0 2a6 6 0 1 0 0 12a6 6 0 0 0 0-12Z" />
        </svg>
        <span class="label">Tìm kiếm</span>
      </a>

      <a class="tab" href="home.php?page=dexuat" aria-selected="<?= $page === 'dexuat' ? 'true' : 'false' ?>">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M5 3l2 4 4 2-4 2-2 4-2-4-4-2 4-2 2-4Zm11 2l1.5 3 3 1.5-3 1.5L16 14l-1.5-3L11 8.5 14.5 7 16 5Zm-2 9l2 4 4 2-4 2-2 4-2-4-4-2 4-2 2-4Z" />
        </svg>
        <span class="label">Đề xuất</span>
      </a>
      <a class="tab" href="home.php?page=tinnhan" aria-selected="<?= $page === 'tinnhan' ? 'true' : 'false' ?>">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M4 4h16v12H7l-3 3V4z" />
        </svg>
        <span class="label">Tin nhắn</span>
      </a>
      <a class="tab" href="home.php?page=me" aria-selected="<?= $page === 'me' ? 'true' : 'false' ?>">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm8 8v-1a7 7 0 0 0-14 0v1z" />
        </svg>
        <span class="label">Tôi</span>
      </a>
    </div>
  </nav>

</body>

</html>