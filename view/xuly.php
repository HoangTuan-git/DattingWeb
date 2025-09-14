<?php
if (!isset($_SESSION['uid'])) {
    echo "<script>alert('Bạn cần đăng nhập để xem danh sách này.')</script>";
    header("refresh:0;url=home.php?page=dangnhap");
    exit;
}

include_once("controller/cxuly.php");
$p = new Cxuly();
$people_who_liked_me = $p->GetAllUserLike();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Người thích bạn</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            padding-bottom: 100px;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
        }

        .people-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .person-item {
            display: flex;
            align-items: center;
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #ddd;
            margin-right: 15px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .person-info {
            flex: 1;
            margin-right: 15px;
        }

        .person-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .person-age {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            width: 44px;
            height: 44px;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn-like {
            background: #22c55e;
            color: white;
        }

        .btn-like:hover {
            background: #16a34a;
            transform: scale(1.1);
        }

        .btn-skip {
            background: #ef4444;
            color: white;
        }

        .btn-skip:hover {
            background: #dc2626;
            transform: scale(1.1);
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        @media (min-width: 768px) {
            .container {
                max-width: 600px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <?php if ($people_who_liked_me && $people_who_liked_me->num_rows > 0): ?>
            <div class="people-list">
                <?php while ($person = $people_who_liked_me->fetch_assoc()): ?>
                    <div class="person-item">
                        <?php
                        $src = "img/" . $person['avatar'];
                        ?>
                        <img src="<?= htmlspecialchars($src ?? 'img/default.png') ?>"
                            alt="Avatar" class="avatar">

                        <div class="person-info">
                            <h3 class="person-name"><?= htmlspecialchars($person['name']) ?></h3>
                            <p class="person-age"><?= htmlspecialchars($person['age']) ?> tuổi</p>
                        </div>

                        <div class="actions">
                            <button class="btn btn-skip" title="Bỏ qua">
                                ✕
                            </button>
                            <button class="btn btn-like" title="Thích lại">
                                ♥
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="empty">
                <div class="empty-icon">💔</div>
                <h3>Chưa có ai thích bạn</h3>
                <p>Hãy cập nhật profile để thu hút nhiều người hơn nhé!</p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>