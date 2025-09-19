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
    public function cAddTinTuc($user_id, $text, $image, $quyenRiengTu)
    {
        $hinhs = "";
        if ($text == '' && count($image["name"]) == 0) {
            return '1';
        }
        for ($i = 0; $i < count($image["name"]); $i++) {
            if ($image['name'][$i] != "") {
                if ($image['size'][$i] > 2 * 1024 * 1024) {
                    return '2';
                }
                if ($image['type'][$i] != 'image/jpeg' && $image['type'][$i] != 'image/png') {
                    return '3';
                }
                $n = pathinfo($image['name'][$i]);
                $n['filename'] = $_SESSION['uid'] . "_" . $_SESSION['email'] . "_img_" . time();
                $folder = 'img/';
                $hinh = $n['filename'] . $n['dirname'] . $n['extension'];
                $newname = $folder . $hinh;
                move_uploaded_file($image['tmp_name'][$i], $newname);

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
                    return '4'; // API lỗi
                }

                // --- Check nudity ---
                if (isset($output['nudity'])) {
                    $nudity = $output['nudity'];
                    if (($nudity['raw'] ?? 0) > 0.5 || ($nudity['partial'] ?? 0) > 0.5) {
                        unlink($newname);
                        return '4';
                    }
                }

                // --- Check weapon ---
                if (isset($output['weapon']['classes'])) {
                    $weapon = $output['weapon']['classes'];
                    if (($weapon['firearm'] ?? 0) > 0.5 || ($weapon['knife'] ?? 0) > 0.5) {
                        unlink($newname);
                        return '4';
                    }
                }

                // --- Check offensive (tục, nazi, khủng bố, v.v.) ---
                if (isset($output['offensive'])) {
                    foreach ($output['offensive'] as $label => $prob) {
                        if ($prob > 0.8 && $label !== 'prob') {
                            unlink($newname);
                            return '4';
                        }
                    }
                }

                // --- tự làm hại bản thân. ---
                if (isset($output['self-harm'])) {
                    if (($output['self-harm']['prob'] ?? 0) > 0.5) {
                        unlink($newname);
                        return '4';
                    }
                }
            } else {
                $hinh = '';
            }
            ($i == 0) ? $hinhs = $hinh : $hinhs = $hinhs . "," . $hinh;
        }
        $p = new mBanTin();
        $kq = $p->mAddTinTuc($user_id, $text, $hinhs, $quyenRiengTu);
        return "5"; // Thành công
    }
}
