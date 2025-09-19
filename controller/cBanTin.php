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
            $n['filename'] = $_SESSION['uid'] . "_" . $_SESSION['email'] . "_img_" . time();
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
        // --- Kiểm tra ảnh bằng API SightEngine ---
        $user = "1287100329";
        $secret = "JUKFmiMnayN6D8MJFMA8H8My5JfYzd4h";

        $ch = curl_init('https://api.sightengine.com/1.0/check.json');
        $params = [
            'media' => new CurlFile($newname),
            'models' => 'nudity,offensive,weapon,self-harm',
            'api_user' => $user,
            'api_secret' => $secret
        ];

        $ch = curl_init('https://api.sightengine.com/1.0/check.json');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $response = curl_exec($ch);
        curl_close($ch);

        $output = json_decode($response, true);

        if (!isset($output['status']) || $output['status'] !== 'success') {
            unlink($newname);
            return '6'; // API lỗi
        }

        // --- Check nudity ---
        if (isset($output['nudity'])) {
            $nudity = $output['nudity'];
            if (($nudity['raw'] ?? 0) > 0.5 || ($nudity['partial'] ?? 0) > 0.5) {
                unlink($newname);
                return '6';
            }
        }

        // --- Check weapon ---
        if (isset($output['weapon']['classes'])) {
            $weapon = $output['weapon']['classes'];
            if (($weapon['firearm'] ?? 0) > 0.5 || ($weapon['knife'] ?? 0) > 0.5) {
                unlink($newname);
                return '6';
            }
        }

        // --- Check offensive (tục, nazi, khủng bố, v.v.) ---
        if (isset($output['offensive'])) {
            foreach ($output['offensive'] as $label => $prob) {
                if ($prob > 0.8 && $label !== 'prob') {
                    unlink($newname);
                    return '6';
                }
            }
        }

        // --- tự làm hại bản thân. ---
        if (isset($output['self-harm'])) {
            if (($output['self-harm']['prob'] ?? 0) > 0.5) {
                unlink($newname);
                return '6';
            }
        }
        $p = new mBanTin();
        $kq = $p->mAddTinTuc($user_id, $text, $hinh, $vidd);
        return "7"; // Thành công
    }
}
