<?php
  session_start();
  include 'include/connect.php';


	$no = $_POST['no'];
	$coId = $_POST['coId'];
	$coContent = $_POST['coContent'];
  $coDate = date('Y-m-d H:i:s');

  $coContent_modify = $_POST['coContent_modify'];

  $sql = "SELECT *FROM comment WHERE num = '$no'";
  $row = mysqli_fetch_assoc($connect->query($sql));

  if(!isset($row)){

    	$insert_sql = "INSERT INTO comment(co_no, num, co_content, co_id, co_date)
              values(null, '$no', '$coContent', '$coId', '$coDate')";

    	$result = $connect->query($insert_sql);


    	if($result) {

    ?>

    	<script>

    		alert('답변이 등록되었습니다.');

    		location.replace("inquiry_view.php?no=<?php echo $no?>");

    	</script>

    <?php

    } 

  } else {

    $sql = "UPDATE comment set co_content = '$coContent_modify' WHERE num = '$no'";
    $result = $connect->query($sql);

    if($result) { ?>

      <script>

        alert('답변이 수정되었습니다.');

        location.replace("inquiry_view.php?no=<?php echo $no?>");

      </script>

    <?php  }

 } ?>
