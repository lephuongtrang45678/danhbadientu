<?php

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt'); // valid extensions
$path = 'user-img/'; // upload directory

if ($_FILES['fileToUpload']) {
    $img = $_FILES['fileToUpload']['name'];
    $tmp = $_FILES['fileToUpload']['tmp_name'];

    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    // can upload same image using rand function
    $final_image = rand(1000, 1000000) . $img;

    // check's valid format
    if (in_array($ext, $valid_extensions)) {
        $path = $path . strtolower($final_image);

        if (move_uploaded_file($tmp, $path)) {
            echo "<img src='$path' style='width: 15%;'/>";
            // $name = $_POST['name'];
            // $email = $_POST['email'];

            // //include database configuration file
            // include_once 'db.php';

            // //insert form data in the database
            // $insert = $db->query("INSERT uploading (name,email,file_name) VALUES ('" . $name . "','" . $email . "','" . $path . "')");

            //echo $insert?'ok':'err';
        }
    } else {
        echo 'invalid';
    }
}
