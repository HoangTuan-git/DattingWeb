<?php
include_once('mKetNoi.php');
class MxuLy
{
    public function GetAllUserLike()
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        $query = "
            SELECT 
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
            WHERE u.user_id IN (
                SELECT uid1 FROM user_status WHERE uid2 = {$_SESSION['uid']} AND status = 'like'
            )
            GROUP BY u.ID, u.name, u.age, u.region_id, u.job_id, k.TenTP, n.nghenghiep, u.user_id
            ";
        $kq = $conn->query($query);
        $p->NgatKetNoi($conn);
        return $kq;
    }
}
