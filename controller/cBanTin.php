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
        if ($text == '' && $image = '' && $vid == '') {
            return '1';
        }
        if ($image['size'] > 2 * 1024 * 1024) {
            return '2';
        }
        if ($vid['size'] > 10 * 1024 * 1024) {
            return '3';
        }
        if ($image['type'] == 'image/jpg' || $image['type'] == 'image/jpeg') {
            true;
        } else {
            return '4';
        }
        if ($vid['type'] == 'video/mp4' || $vid['type'] == 'video/mkv') {
            true;
        } else {
            return '5';
        }
        $p = new mBanTin();
        $kq = $p->mAddTinTuc($user_id, $text, $image, $vid);
        return '6';
    }
    public function cDeleteTinTuc($id)
    {
        $p = new mBanTin();
        $kq = $p->mDeleteTinTuc($id);
        return $kq;
    }
    public function cUpdateTinTuc($id, $text, $image, $vid)
    {
        $p = new mBanTin();
        $kq = $p->mUpdateTinTuc($id, $text, $image, $vid);
        return $kq;
    }
}
