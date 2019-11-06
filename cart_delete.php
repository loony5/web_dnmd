<?php
  include "include/connect.php";
  session_start();

  $no = $_GET['no'];
  $sql = "SELECT *FROM cart WHERE no='$no'";
  $row = mysqli_fetch_assoc($connect->query($sql));

  if($_SESSION['ses_userid'] == $row['memberId']){

    $query = "DELETE FROM cart WHERE no='$no'";
    $result = $connect->query($query);
    ?>
    <script>
      alert("<?php echo "수업이 삭제되었습니다."?>");
      location.replace("<?php echo 'cart.php'?>");
    </script>
  <?php } else {

    ?>
    <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo "main.php"?>");
    </script>
  <?php } ?>
