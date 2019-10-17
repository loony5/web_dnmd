<?php

    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {

            // $check["mime"] -> 파일 형식을 보여준다.
            echo 'File is an image - ' . $check["mime"] . ".";
            $uploadOk = 1;

        } else {
            echo 'File is not an image.';
            $uploadOk = 0;
        
        }

    }

    if(file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 1;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

    } else {

        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<p>The file" . basename($_FILES["fileToUpload"]["name"]). "has
            been uploaded.</p>";

            echo "<br><img src=$target_dir".basename($_FILES["fileToUpload"]["name"]). ">";
            echo "<br><bbutton type='button' onclick='history.back()'>돌아가기</bbutton>";
        } else {
            echo "<p>Sorry, there was an error uploading your file.</p>";
            echo $target_file;
            echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
        }
    }
?>