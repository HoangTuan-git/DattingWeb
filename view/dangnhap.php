
<?php
if(!isset($_REQUEST['page'])){
    header("refresh:0.5;url=../home.php?page=dangnhap");
}
if (isset($_REQUEST['sbtn'])) {
    include_once("controller/cNguoiDung.php");
    $p = new controlNguoiDung();
    $p -> Login($_REQUEST["txtEmail"],$_REQUEST["txtPass"]);
}
?>
<!-- <h2>Đăng nhập</h2> -->
<form method="post" action="">
    <div class="form-group">
        <label for="txtuser">Username:</label>
        <input type="text" name="txtEmail" id="txtuser" required>
    </div>

    <div class="form-group">
        <label for="txtpass">Password:</label>
        <input type="password" name="txtPass" id="txtpass" required>
    </div>
    <input type="submit" class="btn" value="Đăng nhập" name="sbtn">
</form>