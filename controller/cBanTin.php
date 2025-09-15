<?php
include_once('model/mBanTin.php');
class cBanTin
{
    public function cGetAllTinTuc()
    {
        $p = new mBanTin();
        $kq = $p->mGetAllTinTuc();
        return $kq;
    }
    public function cAddTinTuc($user_id, $text, $image, $vid)
    {
        if ($text == '' && $image['name'] == '' && $vid['name'] == '') {
            return '1';
        }
        if ($image['size'] > 2 * 1024 * 1024) {
            return '2';
        }
        if ($vid['size'] > 50 * 1024 * 1024) {
            return '3';
        }
        if ($image['name'] == '' || $image['type'] == 'image/jpg' || $image['type'] == 'image/jpeg') {
            true;
        } else {
            return '4';
        }
        if ($vid['name'] == '' || $vid['type'] == 'video/mp4' || $vid['type'] == 'video/mkv') {
            true;
        } else {
            return '5';
        }
        if ($image['name'] != '') {
            $n = pathinfo($image['name']);
            $n['filename'] = $_SESSION['uid'] . "_img_" . time();
            $folder = 'img/';
            $hinh = $n['filename'] . $n['dirname'] . $n['extension'];
            $newname = $folder . $hinh;
            move_uploaded_file($image['tmp_name'], $newname);
        } else {
            $hinh = '';
        }
        if ($vid['name'] != '') {
            $nv = pathinfo($vid['name']);
            $nv['filename'] = $_SESSION['uid'] . $_SESSION['email'] . "_vid_" . time();
            $folderv = 'vid/';
            $vidd = $nv['filename'] . $nv['dirname'] . $nv['extension'];
            $newnamev = $folderv . $vidd;
            move_uploaded_file($vid['tmp_name'], $newnamev);
        } else {
            $vidd = '';
        }
        $p = new mBanTin();
        $kq = $p->mAddTinTuc($user_id, $text, $hinh, $vidd);
        return '6';
    }
}
