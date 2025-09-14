<?php
include_once('mKetNoi.php');
class Mdexuat
{
    public function GetAllUser()
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $current_uid = $_SESSION['uid'];

        $query = "SELECT 
            u.id,
            u.name,
            u.age,
            u.region_id,
            u.job_id,
            u.avatar,
            k.TenTP,
            n.nghenghiep,
            u.user_id,
            GROUP_CONCAT(s.SoThich ORDER BY s.SoThich SEPARATOR ', ') AS hobbies
        FROM users u
        JOIN khuvuc k ON u.region_id = k.ID
        JOIN nghenghiep n ON u.job_id = n.ID
        JOIN user_table ut ON u.user_id = ut.uid
        LEFT JOIN user_hobbies uh ON u.ID = uh.user_id
        LEFT JOIN sothich s ON uh.hobby_id = s.ID
        WHERE u.user_id != $current_uid
        AND u.user_id NOT IN (
            SELECT uid2 FROM user_status WHERE uid1 = $current_uid
        )
        GROUP BY u.ID, u.name, u.age, u.region_id, u.job_id, k.TenTP, n.nghenghiep, u.user_id
        ORDER BY RAND()
        LIMIT 20";

        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
    public function GetAllKhuVuc()
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $query = "SELECT * FROM khuvuc";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
    public function GetAllSoThich()
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $query = "SELECT * FROM sothich";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
    public function GetAllNgheNghiep()
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $query = "SELECT * FROM nghenghiep";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
    public function InsertUser($uid1, $uid2, $status, $first_like)
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $query = "INSERT INTO user_status (uid1, uid2, status,first_liked_by) VALUES ($uid1, $uid2, '$status',$first_like)";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
    public function HasLiked($uid1, $uid2)
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $query = "SELECT * FROM user_status WHERE uid1 = $uid1 AND uid2 = $uid2 AND status = 'like'";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return ($kq && $kq->num_rows > 0);
    }
}
