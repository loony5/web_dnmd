<?php
//데이터 베이스 연결하기
  include "include/connect.php";

  session_start();

  $ses_userid = $_SESSION['ses_userid'];

  $no = $_GET['no'];

  $sql = "SELECT * FROM board WHERE no='$no' AND memberId='$ses_userid'";
  $row = mysqli_fetch_assoc($connect->query($sql));

  if(!isset($_SESSION['ses_userid']) || $_SESSION['ses_userid'] != $row['memberId']) {

    ?>

    <script>
     alert("권한이 없습니다.");
     location.replace("<?php echo "main.php"?>");
   </script>
   <?php

  }

  if($row) {

    $sql = "DELETE FROM board WHERE no='$no'";
    $connect->query($sql);
    
    ?>

    <script>
      alert("<?php echo "문의글이 삭제되었습니다."?>");
      location.replace("<?php echo "my_inquiry.php"?>");
    </script>
  
  <?php } else {
    
    ?>

      <script>
        alert("문의글 삭제에 실패했습니다.");
        history.go(-1);
      </script>


  <?php }

?>
