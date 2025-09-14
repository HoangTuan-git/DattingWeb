<?php
include_once('model/mNguoiDung.php');
class controlNguoiDung
{
    public function Login($TDN, $MK): void
    {
        $p = new modelNguoiDung();
        $MK = md5($MK);
        $tblTaiKhoan = $p->mLogin($TDN, $MK);
        if (!$tblTaiKhoan) {
            echo "<script>alert('Loi ket noi')</script>";
            header("refresh:0.5;url=home.php?page=dangnhap");
        } else {
            if ($tblTaiKhoan->num_rows > 0) {
                //dang nhap thanh cong
                while ($r = $tblTaiKhoan->fetch_assoc()) {
                    $userId = $r['uid'];
                }
                $_SESSION['uid'] = $userId;
                $_SESSION['email'] = $TDN;
                echo " <script>alert('Dang nhap thanh cong')</script>";
                header("refresh:0.5;url=home.php");
            } else {
                //sai thong tin dang nhap
                echo "<script>alert('Dang nhap that bai')</script>";
                header("refresh:0.5;url=home.php?page=dangnhap");
            }
        }
    }
    public function Regis($TDN, $MK): void
    {
        $p = new modelNguoiDung();
        $MK = md5($MK);
        if (!$p->isUserExist($TDN)) { //ten dn chua ton tai
            $tblTaiKhoan = $p->mRegis($TDN, $MK);
            if (!$tblTaiKhoan) {
                echo "<script>alert('Loi ket noi')</script>";
                header("refresh:0.5;url=home.php?page=dangky");
            } else {
                echo "<script>alert('Dang ky thanh cong!')</script>";
                header("refresh:0.5;url=home.php?page=dangnhap");
            }
        } else { //trung ten dang nhap
            echo '<script>alert("Tên đăng nhập hoặc email đã tồn tại.")</script>';
            header("refresh:0;url=home.php?page=dangky");
        }
    }
    public function isUserExist($user)
    {
        $p = new modelNguoiDung();
        return $p->isUserExist($user);
    }
    public function getAllFriends($uid)
    {
        $p = new modelNguoiDung();
        $tblTaiKhoan = $p->mGetAllFriend($uid);
        return $tblTaiKhoan;
    }

    public function getUser($uid)
    {
        $p = new modelNguoiDung();
        $tblTaiKhoan = $p->mGetUser($uid);
        return $tblTaiKhoan;
    }
}
