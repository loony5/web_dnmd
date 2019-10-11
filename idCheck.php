<?php

    include "include/connect.php";

    $memberId = $_POST['memberId'];

    $sql = "SELECT * FROM member WHERE memberId = '$memberId'";

    $res = $connect->query($sql);


    if($res->num_rows >= 1){
        echo json_encode(array('res'=>'bad'));
    }else{
        echo json_encode(array('res'=>'good'));
    }

?>
