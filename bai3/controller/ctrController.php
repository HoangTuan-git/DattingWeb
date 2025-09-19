<?php
class xuly
{
    private function rename($name)
    {
        $n = pathinfo($name);
        $newname ="upload/". $n["filename"] . "_" . rand(100, 999) . $n["dirname"] . $n["extension"];
        return $newname;
    }
    public function uploadAnh($file)
    {
        for ($i = 0; $i < count($file["name"]); $i++) {
            echo "Ten ban dau:" . $file["name"][$i] . "<br>";
            $newname = $this->rename($file["name"][$i]);
            echo "Ten file thay doi:" . $newname . "<br>";
            $size = $file["size"][$i] / 1024;
            echo "Kich thuoc:" . $size . " KB" . "<br>";
            echo "Loai image:" . $file["type"][$i] . "<br>";
            echo "Ten file tam" . $file["tmp_name"][$i] . "<br>";
            if (move_uploaded_file($file["tmp_name"][$i], $newname)) {
                echo "<img src='$newname' width='200' alt='Không phải ảnh'>" . "<br><br>";
            } else {
                echo "loi gi do";
            }
        }
    }
}
