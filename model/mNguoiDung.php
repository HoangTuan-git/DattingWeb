<?php
include_once('mKetNoi.php');
class modelNguoiDung
{
    private function execQuery($query)
    {
        $p = new mKetNoi();
        $conn = $p->KetNoi();
        if ($conn) {
            $result = $conn->query($query);
            $p->NgatKetNoi($conn);
            return $result;
        } else {
            $p->NgatKetNoi($conn);
            return false;
        }
    }
    public function mGetUser($uid)
    {
        $query = "select * from user_table where uid = $uid";
        $result = $this->execQuery($query);
        return $result;
    }
    public function isUserExist($user)
    {
        $chkUser = "select * from user_table where email='$user'";
        $result = $this->execQuery($chkUser);
        return $result->num_rows > 0;
    }

    public function mRegis($user, $pass)
    {
        $strRegis = "insert into user_table values('','$user','$pass','3')";
        $result = $this->execQuery($strRegis);
        return $result;
    }
    public function mLogin($user, $pass)
    {
        $strLogin = "select * from user_table where email='$user' and password ='$pass'";
        $result =  $this->execQuery($strLogin);
        return $result;
    }
    public function mGetAllFriend($uid)
    {
        $strget1 = "select * from usertable join match_table on usertable.uid = match_table.uid1 where uid2 = $uid";
        $strget2 = "select * from usertable join match_table on usertable.uid = match_table.uid2 where uid1 = $uid";
        $result1 =  $this->execQuery($strget1);
        $result2 =  $this->execQuery($strget2);
        $result = array();
        if ($result1) {
            while ($row = $result1->fetch_assoc()) {
                $result[] = $row;
            }
        }
        if ($result2) {
            while ($row = $result2->fetch_assoc()) {
                $result[] = $row;
            }
        }
        return $result;
    }
}
