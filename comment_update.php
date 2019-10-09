<?php
  session_start();
  include '../dnmd/include/connect.php';


	$no = $_POST['no'];
	$coId = $_POST['coId'];
	$coContent = $_POST['coContent'];
  $coDate = date('Y-m-d H:i:s');

  $coContent_modify = $_POST['coContent_modify'];

  $sql = "select *from comment where num = '$no'";
  $result = $connect->query($sql);
  $row = $result->fetch_assoc();

  if(!isset($row)){

    	$comment_sql = "insert into comment(co_no, num, co_content, co_id, co_date)
              values(null, '$no', '$coContent', '$coId', '$coDate')";

    	$result = $connect->query($comment_sql);


    	if($result) {

    ?>

    	<script>

    		alert('답변이 등록되었습니다.');

    		location.replace("./view.php?no=<?php echo $no?>");

    	</script>

    <?php

  } else {
    echo $no;
  }

  } else {

    $sql = "update comment set co_content = '$coContent_modify' where num = '$no'";
    $result = $connect->query($sql);

    if($result) { ?>

      <script>

        alert('답변이 수정되었습니다.');

        location.replace("./view.php?no=<?php echo $no?>");

      </script>

    <?php  }

 } ?>
