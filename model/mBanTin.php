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
    public function mAddTinTuc($user_id, $text, $image, $vid)
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $text = $conn->real_escape_string($text);
        $image = $conn->real_escape_string($image);
        $vid = $conn->real_escape_string($vid);
        $query = "INSERT INTO news (user_id ,text_content, image_content, vid_content) VALUES ('$user_id', '$text', '$image','$vid')";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
    public function mDeleteTinTuc($id)
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $query = "DELETE FROM news WHERE id = $id";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
    public function mUpdateTinTuc($id, $text, $image, $vid)
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $text = $conn->real_escape_string($text);
        $image = $conn->real_escape_string($image);
        $vid = $conn->real_escape_string($vid);
        $query = "UPDATE news SET text_content = '$text', image_content = '$image', vid_content = '$vid' WHERE id = $id";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
}
