<?php
  include "../dnmd/include/connect.php";

  session_start();

  $no = $_GET['no'];
  $sql = "select *from cart where no='$no'";
  $result = $connect->query($sql);
  $row = $result->fetch_assoc();

  if($_SESSION['ses_userid'] == $row['memberId']){

    $query = "delete from cart where no='$no'";
    $res = $connect->query($query);
    ?>
    <script>
      alert("<?php echo "수업이 삭제되었습니다."?>");
      location.replace("<?php echo '../dnmd/my.php'?>");
    </script>
  <?php } else {

    ?>
    <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo "./main.php"?>");
    </script>
  <?php } ?>
