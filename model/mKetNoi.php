<?php
    class mKetNoi{
        public function KetNoi(){
            $user='sangtuan';
            $host='localhost';
            $pass='123456';
            $db='dating_app';
            return mysqli_connect($host,$user,$pass,$db);
        }
        public function NgatKetNoi($conn){
            $conn->close();
        }
    }
?>