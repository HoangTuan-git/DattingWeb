<?php
include_once('mKetNoi.php');
class mMe
{
    public function GetUserById($uid)
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $query = "SELECT * FROM users WHERE user_id = $uid";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
}
