<?php
if (!isset($_SESSION['uid'])) {
  echo "<script>alert('Bạn cần đăng nhập để xem đề xuất.')</script>";
  header("refresh:0;url=home.php?page=dangnhap");
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Đề xuất</title>
  <style>
    :root {
      --bg: #eef2ff;
      --card: #0f172a;
      --muted: #94a3b8;
      --like: #22c55e;
      --skip: #ef4444;
    }

    * {
      box-sizing: border-box
    }

    body {
      margin: 0;
      font-family: system-ui, -apple-system, Roboto, Arial, sans-serif;
      background: var(--bg)
    }

    .wrap {
      max-width: 520px;
      margin: 0 auto;
      padding: 12px 12px 110px
    }

    /* Bộ lọc */
    .dx-controls {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      align-items: center;
      margin-bottom: 10px
    }

    .dx-dd {
      flex: 1 1 180px;
      padding: 10px 12px;
      border: 1px solid #cbd5e1;
      border-radius: 12px;
      background: #fff
    }

    .dx-apply,
    .dx-reset {
      padding: 10px 14px;
      border-radius: 12px;
      border: 0;
      cursor: pointer;
      font-weight: 700
    }

    .dx-apply {
      background: #6d28d9;
      color: #fff
    }

    .dx-reset {
      background: #f1f5f9;
      color: #0f172a;
      border: 1px solid #cbd5e1
    }

    /* STACK LAYOUT – luôn chồng thẻ cho mọi kích thước */
    .cards {
      position: relative;
      width: 100%;
      aspect-ratio: 3/4
    }

    .card {
      position: absolute;
      inset: 0;
      border-radius: 20px;
      overflow: hidden;
      background: var(--card);
      box-shadow: 0 16px 40px rgba(2, 6, 23, .28);
      transition: transform .35s ease, opacity .35s ease;
    }

    .photo {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover
    }

    .fade {
      position: absolute;
      inset: 0;
      background: linear-gradient(transparent 45%, rgba(0, 0, 0, .55))
    }

    .badge {
      position: absolute;
      top: 10px;
      left: 10px;
      padding: 6px 10px;
      border-radius: 999px;
      color: #fff;
      font-size: 12px;
      background: rgba(255, 255, 255, .14);
      backdrop-filter: blur(6px);
      border: 1px solid rgba(255, 255, 255, .25)
    }

    .info {
      position: absolute;
      left: 14px;
      right: 14px;
      bottom: 96px;
      color: #fff;
      text-shadow: 0 2px 10px rgba(0, 0, 0, .6)
    }

    .name {
      font-weight: 800;
      font-size: clamp(18px, 4.5vw, 24px)
    }

    .meta {
      color: #cbd5e1;
      font-weight: 600;
      margin-top: 2px
    }

    .actions {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 18px;
      display: flex;
      justify-content: center;
      gap: 20px;
      z-index: 2
    }

    .btn-circle {
      width: 72px;
      height: 72px;
      border-radius: 50%;
      border: 0;
      display: grid;
      place-items: center;
      color: #fff;
      font-size: 30px;
      box-shadow: 0 14px 30px rgba(0, 0, 0, .38);
      cursor: pointer;
      transition: transform .08s
    }

    .btn-circle:active {
      transform: scale(.95)
    }

    .btn-like {
      background: var(--like)
    }

    .btn-skip {
      background: var(--skip)
    }

    /* Desktop chỉ nới rộng vùng hiển thị cho đẹp – vẫn stack */
    @media (min-width: 768px) {
      .wrap {
        max-width: 640px;
        padding: 24px 24px 120px
      }

      .btn-circle {
        width: 76px;
        height: 76px;
        font-size: 32px
      }

      .info {
        bottom: 110px
      }
    }

    /* Hết đề xuất */
    .empty {
      position: absolute;
      inset: 0;
      display: none;
      place-items: center;
      text-align: center;
      background: #fff;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      box-shadow: 0 8px 24px rgba(2, 6, 23, .06);
      color: #64748b;
      font-weight: 700;
      padding: 24px
    }

    .cards.is-empty .empty {
      display: grid
    }
  </style>
</head>

<body>
  <?php
  include_once("model/mdexuat.php");
  $p = new Mdexuat();

  // Xử lý nút thích TRƯỚC khi load data
  if (isset($_POST['btnthich'])) {
    $uid1 = $_SESSION['uid'];
    $uid2 = $_POST['btnthich'];

    // Kiểm tra nếu đã thích rồi thì không thêm nữa
    // if (!$p->HasLiked($currentUserId, $likedUserId)) {
    $p->InsertUser($uid1, $uid2, 'like', $uid1);
    // } else {
    //   echo "<script>alert('Bạn đã thích người dùng này trước đó rồi!')</script>";
    // }
  }

  $khuvuc = $p->GetAllKhuVuc();
  $users  = $p->GetAllUser();
  $selected = $_POST['region'] ?? '';
  ?>
  <div class="wrap">
    <!-- Bộ lọc -->
    <form class="dx-controls" action="home.php?page=dexuat" method="post">
      <select class="dx-dd" name="region">
        <option value="">-- Chọn khu vực --</option>
        <?php while ($r = $khuvuc->fetch_assoc()): ?>
          <option value="<?= htmlspecialchars($r['ID']) ?>" <?= ($selected == $r['ID'] ? ' selected' : '') ?>>
            <?= htmlspecialchars($r['TenTP']) ?>
          </option>
        <?php endwhile; ?>
      </select>
      <button class="dx-apply" type="submit" name="btn">Áp dụng</button>
      <button class="dx-reset" type="button" onclick="location.href='home.php?page=dexuat'">Đặt lại</button>
    </form>

    <!-- Stack thẻ -->
    <?php
    if (isset($_POST['btn']) && $selected !== '') {
      echo '<div class="cards" id="cardContainer">';
      echo '<div class="empty">Tạm thời hết đề xuất phù hợp.</div>';
      $regionid = $selected;
      $count = 0;
      while ($u = $users->fetch_assoc()) {
        if ($regionid === '' || $u['region_id'] == $regionid) {
          $count++;
          $src = "img/" . $u['avatar'];
    ?>
          <form method="post">
            <div class="card">
              <img class="photo" src="<?= htmlspecialchars($src ?? 'img/default.png') ?>" alt="avatar">
              <div class="fade"></div>
              <span class="badge"><?= htmlspecialchars($u['TenTP']) ?></span>
              <div class="info">
                <div class="name"><?= htmlspecialchars($u['name']) ?>, <?= (int)$u['age'] ?></div>
                <div class="meta">Khu vực: <?= htmlspecialchars($u['TenTP']) ?></div>
              </div>
              <div class="actions">
                <button class="btn-circle btn-skip" type="button" title="Bỏ qua">✕</button>
                <button class="btn-circle btn-like" type="submit" name='btnthich' value="<?= htmlspecialchars($u['user_id']) ?>" title="Thích">♥</button>
              </div>
            </div>
          </form>
    <?php
        }
      }
      if ($count === 0) {
        // không có thẻ nào, bật trạng thái rỗng bằng JS ở dưới
      }
    } else {
      echo '<div class="cards is-empty" id="cardContainer">';
      echo '<div class="empty">Hãy chọn bộ lọc và nhấn "Áp dụng" để xem đề xuất.</div>';
    }
    ?>
  </div>
  </div>

  <script>
    // Tinder-like stack cho cả mobile & desktop
    (function() {
      const container = document.getElementById('cardContainer');
      if (!container) return;

      const allCards = Array.from(container.querySelectorAll('.card'));
      if (allCards.length === 0) {
        container.classList.add('is-empty');
        return;
      }

      // xếp chồng: card đầu on top
      allCards.forEach((c, i) => {
        c.style.zIndex = (allCards.length - i).toString();
        c.style.opacity = (i === 0 ? '1' : '1'); // thẻ dưới vẫn thấy ở mép
        c.style.transform = `translateY(${i * 4}px) scale(${1 - i * 0.02})`;
      });

      let idx = 0;

      function updateStack() {
        const rest = allCards.slice(idx);
        if (rest.length === 0) {
          container.classList.add('is-empty');
          return;
        }
        container.classList.remove('is-empty');
        rest.forEach((c, i) => {
          c.style.transition = 'transform .35s ease, opacity .35s ease';
          c.style.zIndex = (rest.length - i).toString();
          c.style.opacity = '1';
          c.style.pointerEvents = (i === 0 ? 'auto' : 'none');
          c.style.transform = `translateY(${i * 4}px) scale(${1 - i * 0.02})`;
        });
      }

      function act(direction) {
        const card = allCards[idx];
        if (!card) return;

        // animate ra 2 hướng
        const dx = (direction === 'like') ? 160 : -160;
        const rot = (direction === 'like') ? 15 : -15;
        card.style.transform = `translate(${dx}%, -10%) rotate(${rot}deg)`;
        card.style.opacity = '0';

        // sang thẻ kế
        setTimeout(() => {
          idx++;
          updateStack();
        }, 350);
      }

      // gắn sự kiện
      allCards.forEach(c => {
        // Cho phép nút Like submit form thực sự (không preventDefault)
        c.querySelector('.btn-skip')?.addEventListener('click', () => act('skip'));
      });

      updateStack();
    })();
  </script>
</body>

</html>