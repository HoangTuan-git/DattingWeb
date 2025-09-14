<?php
include_once(__DIR__ . "/../controller/cNguoiDung.php");
$p = new controlNguoiDung();

if (!isset($_REQUEST['page'])) {
    header("refresh:0.5;url=../home.php?page=dangky");
}

if (isset($_REQUEST['sbtn'])) {
    $email = $_POST["txtEmail"];
    $pass = $_POST["txtPass"];
    $terms = isset($_POST["terms"]) ? $_POST["terms"] : false;

    if (!$terms) {
        echo "<script>alert('Bạn phải đồng ý với điều khoản sử dụng để đăng ký!');</script>";
    } else {
        $p->Regis($email, $pass);
    }
}
?>

<style>
    /* Reset margin cho main content */
    .screen {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-height: calc(100vh - 140px) !important;
        /* Trừ đi chiều cao header + footer */
        padding: 20px 16px !important;
    }

    .signup-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        padding: 2rem;
        margin: 0 auto;
    }

    .signup-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .brand-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .brand-icon i {
        font-size: 1.8rem;
        color: white;
    }

    .signup-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .signup-subtitle {
        color: #718096;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f7fafc;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
    }

    .password-field {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #718096;
        cursor: pointer;
        padding: 0;
    }

    .terms-section {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1rem;
        margin: 1.5rem 0;
        border: 2px solid #e2e8f0;
    }

    .form-check {
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .form-check-input {
        margin: 0;
        flex-shrink: 0;
        margin-top: 0.125rem;
    }

    .form-check-label {
        font-size: 0.9rem;
        color: #4a5568;
        line-height: 1.4;
    }

    .form-check-label a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .form-check-label a:hover {
        text-decoration: underline;
    }

    .btn-signup {
        width: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 1rem;
        font-size: 1.05rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
    }

    .btn-signup:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .btn-signup:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .login-link {
        text-align: center;
        color: #718096;
        font-size: 0.95rem;
    }

    .login-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    /* Mobile responsive */
    @media (max-width: 480px) {
        .screen {
            padding: 10px !important;
        }

        .signup-container {
            padding: 1.5rem;
        }

        .signup-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="signup-container">
    <div class="signup-header">
        <div class="brand-icon">
            <i class="bi bi-heart-fill"></i>
        </div>
        <h1 class="signup-title">Đăng ký</h1>
        <p class="signup-subtitle">Tạo tài khoản để bắt đầu kết nối</p>
    </div>

    <form method="post" id="signupForm">
        <!-- Email Field -->
        <div class="form-group">
            <label for="txtEmail" class="form-label">
                <i class="bi bi-envelope me-2"></i>Email
            </label>
            <input type="email"
                class="form-control"
                id="txtEmail"
                name="txtEmail"
                placeholder="Nhập địa chỉ email của bạn"
                required>
        </div>

        <!-- Password Field -->
        <div class="form-group">
            <label for="txtPass" class="form-label">
                <i class="bi bi-lock me-2"></i>Mật khẩu
            </label>
            <div class="password-field">
                <input type="password"
                    class="form-control"
                    id="txtPass"
                    name="txtPass"
                    placeholder="Nhập mật khẩu (tối thiểu 6 ký tự)"
                    required
                    minlength="6">
                <button type="button" class="password-toggle" onclick="togglePassword()">
                    <i class="bi bi-eye" id="toggleIcon"></i>
                </button>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="confirmPass" class="form-label">
                <i class="bi bi-lock-fill me-2"></i>Xác nhận mật khẩu
            </label>
            <input type="password"
                class="form-control"
                id="confirmPass"
                name="confirmPass"
                placeholder="Nhập lại mật khẩu"
                required>
        </div>

        <!-- Terms Checkbox -->
        <div class="terms-section">
            <div class="form-check">
                <input class="form-check-input"
                    type="checkbox"
                    id="terms"
                    name="terms"
                    required>
                <label class="form-check-label" for="terms">
                    Tôi đồng ý với <a href="#" onclick="showTerms()">Điều khoản sử dụng</a>
                    và <a href="#" onclick="showPrivacy()">Chính sách bảo mật</a> của ứng dụng
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="sbtn" class="btn-signup">
            <i class="bi bi-person-plus me-2"></i>
            Tạo tài khoản
        </button>

        <!-- Login Link -->
        <div class="login-link">
            Đã có tài khoản?
            <a href="home.php?page=dangnhap">Đăng nhập ngay</a>
        </div>
    </form>
</div>

<script>
    // Toggle password visibility
    function togglePassword() {
        const passwordInput = document.getElementById('txtPass');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.className = 'bi bi-eye-slash';
        } else {
            passwordInput.type = 'password';
            toggleIcon.className = 'bi bi-eye';
        }
    }

    // Form validation
    document.getElementById('signupForm').addEventListener('submit', function(e) {
        const password = document.getElementById('txtPass').value;
        const confirmPassword = document.getElementById('confirmPass').value;
        const terms = document.getElementById('terms').checked;

        // Check terms
        if (!terms) {
            e.preventDefault();
            alert('Bạn phải đồng ý với điều khoản sử dụng!');
            return;
        }

        // Check password match
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Mật khẩu xác nhận không khớp!');
            return;
        }

        // Check password length
        if (password.length < 6) {
            e.preventDefault();
            alert('Mật khẩu phải có ít nhất 6 ký tự!');
            return;
        }
    });

    // Real-time password matching
    document.getElementById('confirmPass').addEventListener('input', function() {
        const password = document.getElementById('txtPass').value;
        const confirmPassword = this.value;

        if (confirmPassword && password !== confirmPassword) {
            this.style.borderColor = '#e53e3e';
        } else {
            this.style.borderColor = '#e2e8f0';
        }
    });

    // Show terms modal (simple alert for now)
    function showTerms() {
        alert('Điều khoản sử dụng:\n\n1. Sử dụng ứng dụng một cách văn minh\n2. Không spam hay quấy rối người khác\n3. Cung cấp thông tin chính xác\n4. Tuân thủ pháp luật Việt Nam');
    }

    function showPrivacy() {
        alert('Chính sách bảo mật:\n\n1. Thông tin cá nhân được mã hóa và bảo vệ\n2. Không chia sẻ dữ liệu với bên thứ ba\n3. Bạn có quyền xóa tài khoản bất kỳ lúc nào\n4. Tuân thủ GDPR và luật bảo vệ dữ liệu');
    }
</script>