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
    'tinnhan'    => 'Tin nhắn',
    'me'         => 'Tôi'
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
      --bg-main: #f0f9ff;
      --bg-nav: #ffffff;
      --text: #475569;
      --text-active: #6d28d9;
      --shadow: 0 -8px 24px rgba(15, 23, 42, .08);
      --border: #cbd5e1;
      --fab: #7c3aed;
    }
    *{box-sizing:border-box}
    body{
      margin:0; min-height:100svh;
      font-family: system-ui, Arial, sans-serif;
      background:var(--bg-main); color:#0f172a;
      padding-bottom:100px; /* chừa chỗ cho nav */
    }
    header{padding:24px 16px 8px;}
    .hint{color:#64748b}

    .bottom-nav{
      position:fixed; left:0; right:0; bottom:0;
      margin-inline:auto; max-width:480px;
      background:var(--bg-nav);
      border-top:2px solid var(--border);
      border-radius:16px 16px 0 0;
      box-shadow:var(--shadow);
      padding:8px 8px calc(8px + env(safe-area-inset-bottom,0px));
      z-index:30;
    }
    .tabs{
      display:grid;
      grid-template-columns:repeat(5,1fr);
      align-items:center; gap:4px;
    }
    .tab{
      text-decoration:none;
      display:flex; flex-direction:column; align-items:center; gap:4px;
      padding:6px 4px;
      color:var(--text);
      border-radius:12px;
    }
    .tab[aria-selected="true"]{color:var(--text-active); font-weight:600;}
    .tab svg{width:24px;height:24px;}
    .label{font-size:11px;}

    .screen{max-width:480px;margin:0 auto;padding:8px 16px 0;}
    .card{background:#fff;border:1px solid var(--border);border-radius:16px;
          padding:16px;box-shadow:0 4px 12px rgba(15,23,42,.06);margin:12px 0;}
  </style>
</head>
<body>

  <!-- Header -->
  <header class="screen">
    <h2 style="margin:0 0 4px"><?= htmlspecialchars($titles[$page]) ?></h2>
    <div class="hint">Demo: nền chính xanh nhạt, thanh nav trắng</div>
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
          case 'home':
          default:
            echo  'Trang chu';
        }
      ?>
  </main>

  <!-- Bottom Navigation -->
  <nav class="bottom-nav" role="tablist">
    <div class="tabs">
      <a class="tab" href="home.php" aria-selected="<?= $page==='home'?'true':'false' ?>">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 3 3 10v11h6v-6h6v6h6V10z"/></svg>
        <span class="label">Trang chủ</span>
      </a>
      <a class="tab" href="home.php?page=timkiem" aria-selected="<?= $page==='timkiem'?'true':'false' ?>">
  <!-- Icon kính lúp -->
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M10 2a8 8 0 1 1-5.29 13.71l-4 4a1 1 0 0 1-1.42-1.42l4-4A8 8 0 0 1 10 2Zm0 2a6 6 0 1 0 0 12a6 6 0 0 0 0-12Z"/></svg>
        <span class="label">Tìm kiếm</span>
      </a>

      <a class="tab" href="home.php?page=dexuat" aria-selected="<?= $page==='dexuat'?'true':'false' ?>">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M5 3l2 4 4 2-4 2-2 4-2-4-4-2 4-2 2-4Zm11 2l1.5 3 3 1.5-3 1.5L16 14l-1.5-3L11 8.5 14.5 7 16 5Zm-2 9l2 4 4 2-4 2-2 4-2-4-4-2 4-2 2-4Z"/>
        </svg>
        <span class="label">Đề xuất</span>
      </a>
      <a class="tab" href="home.php?page=tinnhan" aria-selected="<?= $page==='tinnhan'?'true':'false' ?>">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M4 4h16v12H7l-3 3V4z"/></svg>
        <span class="label">Tin nhắn</span>
      </a>
      <a class="tab" href="home.php?page=me" aria-selected="<?= $page==='me'?'true':'false' ?>">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm8 8v-1a7 7 0 0 0-14 0v1z"/></svg>
        <span class="label">Tôi</span>
      </a>
    </div>
  </nav>

</body>
</html>
