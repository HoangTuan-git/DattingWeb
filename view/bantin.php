<?php
include_once("controller/cBanTin.php");
$cBanTin = new cBanTin();
if (isset($_POST['postNews'])) {
    $p = $cBanTin->cAddTinTuc($_SESSION['uid'], $_POST['newsContent'], $_FILES['newsImage'], $_FILES['newsVideo']);
    switch ($p) {
        case '1':
            echo '<script>alert("Lỗi: Bạn phải nhập nội dung hoặc chọn file để đăng!")</script>';
            break;
        case '2':
            echo '<script>alert("Lỗi: Kích thước ảnh quá lớn (tối đa 2MB)!")</script>>';
            break;
        case '3':
            echo '<script>alert("Lỗi: Kích thước video quá lớn (tối đa 50MB)!")</script>';
            break;
        case '4':
            echo '<script>alert("Lỗi: Định dạng ảnh không được hỗ trợ (chỉ chấp nhận JPG/JPEG)!")</script>';
            break;
        case '5':
            echo '<script>alert("Lỗi: Định dạng video không được hỗ trợ (chỉ chấp nhận MP4/MKV)!")</script>';
            break;
        case '6':
            echo '<script>alert("Lỗi: Ảnh không phù hợp!")</script>';
            break;
        case '7':
            echo '<script>alert("Đăng bản tin thành công!")</script>';
            break;
        default:
            echo '<script>alert("Đã xảy ra lỗi không xác định!")</script>';
            break;
    }
    header("refresh:0.5;url=home.php?page=bantin");
}

?>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.15);
        --border-radius: 12px;
    }

    .main-container {
        background: #f8f9fa;
        min-height: calc(100vh - 140px);
        padding: 20px 0;
    }

    .post-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        border: 1px solid #e9ecef;
        margin-bottom: 20px;
        transition: all 0.2s ease;
    }

    .post-card:hover {
        box-shadow: var(--shadow-md);
    }

    .avatar-circle {
        width: 50px !important;
        height: 50px !important;
        background: var(--primary-gradient);
        border-radius: 50% !important;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 16px;
        object-fit: cover;
        flex-shrink: 0;
        border: 3px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .avatar-lg {
        width: 50px !important;
        height: 50px !important;
        font-size: 18px;
    }

    .post-input {
        background: #f8f9fa;
        border: none;
        border-radius: 25px;
        padding: 12px 20px;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #6c757d;
    }

    .post-input:hover {
        background: #e9ecef;
    }

    .btn-gradient {
        background: var(--primary-gradient);
        border: none;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-gradient:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        color: white;
    }

    /* Responsive Layout cho Desktop */
    @media (min-width: 1200px) {
        .feed-container {
            max-width: 800px;
        }
    }

    @media (min-width: 992px) and (max-width: 1199.98px) {
        .feed-container {
            max-width: 700px;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        .feed-container {
            max-width: 600px;
        }
    }

    @media (max-width: 767.98px) {
        .feed-container {
            max-width: 100%;
            padding: 0 10px;
        }

        .main-container {
            padding: 10px 0;
        }
    }
</style>

<div class="main-container">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Sử dụng container tùy chỉnh thay vì col-lg-6 -->
            <div class="feed-container mx-auto">
                <!-- Post Input Card -->
                <div class="post-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <?php if (isset($_SESSION['uid'])):
                                include_once("model/mme.php");
                                $p = new mMe();
                                $user = $p->GetUserById($_SESSION['uid']);
                                $u = $user->fetch_assoc();
                                $src = 'img/' . ($u['avatar'] ?? 'default.png');
                            ?>

                                <img src="<?= htmlspecialchars($src) ?>"
                                    alt="Avatar"
                                    class="avatar-circle me-3">
                                <div class="post-input flex-fill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#postModal"
                                    role="button" onclick="resetModal()">
                                    <?= htmlspecialchars($_SESSION['email']) ?> ơi, bạn đang nghĩ gì thế?
                                </div>
                            <?php else: ?>
                                <div class="post-input flex-fill text-center"
                                    onclick="window.location.href='home.php?page=dangnhap'"
                                    role="button">
                                    Đăng nhập để đăng bài tương tác
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if (isset($_SESSION['uid'])): ?>
                            <hr class="my-3">
                            <div class="row text-center g-2" style="font-size: 14px;" onclick="resetModal()">
                                <div class="col-4">
                                    <button class="btn btn-light w-100 py-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#postModal">
                                        <i class="bi bi-image text-success me-2"></i>
                                        <span>Ảnh</span>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-light w-100 py-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#postModal">
                                        <i class="bi bi-camera-video text-danger me-2"></i>
                                        <span>Video</span>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-light w-100 py-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#postModal">
                                        <i class="bi bi-emoji-smile text-warning me-2"></i>
                                        <span>Emoji</span>
                                    </button>
                                </div>
                            </div>
                        <?php else: ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- News Feed -->
            </div>
        </div>
    </div>
</div>

<!-- Post Modal -->
<div class="modal fade" id="postModal" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold" id="postModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>Tạo bản tin
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="resetModal()"></button>
                </div>

                <div class="modal-body">
                    <!-- User Info -->
                    <div class="d-flex align-items-center mb-4">
                        <img src="<?= htmlspecialchars($src ?? 'img/default.png') ?>"
                            alt="Avatar"
                            class="avatar-circle avatar-lg me-3">
                        <div>
                            <h6 class="mb-0 fw-bold">
                                <?= isset($_SESSION['uid']) ? htmlspecialchars($_SESSION['email']) : 'Người dùng' ?>
                            </h6>
                            <small class="text-muted">
                                <i class="bi bi-globe me-1"></i>Công khai
                            </small>
                        </div>
                    </div>

                    <!-- Content Input -->
                    <div class="mb-4">
                        <textarea name="newsContent"
                            class="form-control border-0 fs-5"
                            style="resize: none; min-height: 120px;"
                            placeholder="Bạn đang nghĩ gì?"></textarea>
                    </div>

                    <!-- Media Upload Section -->
                    <div class="border rounded-3 p-3 mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="fw-medium">Thêm vào bản tin của bạn</span>
                        </div>

                        <div class="d-flex gap-2 mb-3">
                            <label class="btn btn-outline-success btn-sm flex-fill" for="imageInput">
                                <i class="bi bi-image me-2"></i>Hình ảnh
                            </label>
                            <input type="file"
                                id="imageInput"
                                name="newsImage"
                                class="d-none" onchange="showFile(this)">
                            <label class="btn btn-outline-danger btn-sm flex-fill" for="videoInput">
                                <i class="bi bi-camera-video me-2"></i>Video
                            </label>
                            <input type="file"
                                id="videoInput"
                                name="newsVideo"
                                class="d-none">
                            <button type="button" class="btn btn-outline-warning btn-sm flex-fill">
                                <i class="bi bi-emoji-smile me-2"></i>Cảm xúc
                            </button>
                        </div>
                    </div>
                    <!-- Hiển thị hình ảnh -->
                    <div id="previewSection" class="mb-3">
                        <div class="position-relative d-inline-block">
                            <img src="" alt="" id="img-preview" style="max-width: 200px; display: none;">
                            <!-- Nút xóa ảnh -->
                            <button type="button"
                                class="btn btn-secondary btn-sm position-absolute top-0 end-0"
                                style="display: none; width: 25px; height: 25px; padding: 0; border-radius: 50%; font-size: 12px;"
                                id="remove-img-btn"
                                onclick="clearFile()">×</button>
                        </div>
                    </div>

                </div>

                <div class="modal-footer border-top">
                    <button type="submit" name="postNews" class="btn btn-gradient btn-lg w-100 rounded-pill">
                        <i class="bi bi-send me-2"></i>Đăng bản tin
                    </button>
                </div>

            </form>
        </div>
    </div>
    <script>
        function resetModal() {
            // Reset form đúng cách
            const form = document.querySelector('#postModal form');
            if (form) form.reset();
            // Ẩn ảnh preview
            document.getElementById("img-preview").style.display = "none";
            document.getElementById("remove-img-btn").style.display = "none";
            document.getElementById("img-preview").src = "";
            document.getElementById("imageInput").value = "";
            document.getElementById("videoInput").value = "";
            document.getElementsByClassName("form-control").value = "";
        }

        function showFile(input) {
            const file = input.files[0];
            if (file) {
                const preview = document.getElementById("img-preview");
                const removeBtn = document.getElementById("remove-img-btn");
                preview.src = URL.createObjectURL(file); // tạo đường dẫn tạm
                preview.style.display = "block";
                preview.style.borderRadius = "8px"; // Thêm border radius cho đẹp
                preview.style.marginTop = "10px";

                if (removeBtn) {
                    removeBtn.style.display = "block";
                }
            }
        }

        function clearFile(input) {
            const preview = document.getElementById("img-preview");
            const removeBtn = document.getElementById("remove-img-btn");
            preview.style.display = "none";
            preview.src = "";
            document.getElementById("imageInput").value = "";
            if (removeBtn) {
                removeBtn.style.display = "none";
            }
        }
    </script>
</div>