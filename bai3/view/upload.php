<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="#" name="frm" method="POST" enctype="multipart/form-data">
        <input type="file" name="files[]" multiple>
        <input type="submit" name="sbupload" value="Upload">
    </form>
    <?php
    include("controller/ctrController.php");
    if (isset($_POST["sbupload"])) {
        $a = new xuly();
        $a->uploadAnh($_FILES["files"]);
    }
    ?>
</body>

</html>