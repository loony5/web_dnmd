<?php
//데이터 베이스 연결하기
  session_start();
  include "../dnmd/include/connect.php";

  if(!isset($_SESSION['ses_userid']) || $_SESSION['ses_userid'] != 'admin'){

    ?>
    
    <script>
     alert("권한이 없습니다.");
     location.replace("<?php echo "index.php"?>");
   </script>

   <?php

 }

  $no = $_GET['no'];

  $sql = "SELECT *FROM class WHERE no='$no'";
  $row = mysqli_fetch_assoc($connect->query($sql));
  
    if($row) {

      unlink("images/".$row['image']);

      $sql = "DELETE FROM class WHERE no='$no'";
      $connect->query($sql);

      ?>
      <script>
        alert("<?php echo "수업이 삭제되었습니다."?>");
        location.replace("<?php echo "admin.php"?>");
      </script>

    <?php } else {

      ?>
      <script>
        alert("수업 삭제에 실패했습니다.");
        history.go(-1);
      </script>
    <?php }

    ?>

