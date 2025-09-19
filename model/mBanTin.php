<?php
include_once('mKetNoi.php');
class mBanTin
{
    public function mGetAllTinTuc()
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $query = "SELECT * FROM news ORDER BY id DESC";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
    public function mAddTinTuc($user_id, $text, $image, $quyenRiengTu)
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $text = $conn->real_escape_string($text);
        $image = $conn->real_escape_string($image);
        $quyenRiengTu = $conn->real_escape_string($quyenRiengTu);
        $query = "INSERT INTO news (user_id ,text_content, image_content, quyenRiengTu) VALUES ('$user_id', '$text', '$image','$quyenRiengTu')";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
}
